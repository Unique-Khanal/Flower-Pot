<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VendorPayoutPaidMail;
use App\Models\OrderItem;
use App\Models\Vendor;
use App\Models\VendorPayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class VendorPayoutController extends Controller
{
    /**
     * For every approved vendor: how much of their DELIVERED sales hasn't
     * been paid out yet. "Unpaid" here means order_items with
     * vendor_payout_id still NULL — nothing to do with Order.payment_status,
     * which tracks whether the CUSTOMER paid us, not whether we've paid
     * the vendor their share.
     */
    public function index(): View
    {
        $vendors = Vendor::where('status', 'approved')
            ->orderBy('business_name')
            ->get()
            ->map(function (Vendor $vendor) {
                $unpaidItems = OrderItem::where('vendor_id', $vendor->id)
                    ->whereNull('vendor_payout_id')
                    ->whereHas('order', fn ($q) => $q->where('status', 'delivered'))
                    ->get();

                $vendor->unpaid_sales      = $unpaidItems->sum('subtotal');
                $vendor->unpaid_commission = $unpaidItems->sum('commission_amount');
                $vendor->unpaid_payout     = $vendor->unpaid_sales - $vendor->unpaid_commission;
                $vendor->unpaid_count      = $unpaidItems->count();
                $vendor->last_payout       = $vendor->payouts()->latest()->first();

                return $vendor;
            });

        return view('admin.payouts.index', compact('vendors'));
    }

    /**
     * Creates one payout covering every delivered, not-yet-settled
     * order_item for this vendor, then tags each item with the new
     * payout's id so it can never be included in a future payout — this
     * is what makes it safe to click "Generate" repeatedly over time
     * instead of only once per fixed period.
     */
    public function generate(Vendor $vendor): RedirectResponse
    {
        $items = OrderItem::where('vendor_id', $vendor->id)
            ->whereNull('vendor_payout_id')
            ->whereHas('order', fn ($q) => $q->where('status', 'delivered'))
            ->with('order')
            ->get();

        if ($items->isEmpty()) {
            return back()->with('error', "{$vendor->business_name} has no unpaid delivered sales right now.");
        }

        $payout = DB::transaction(function () use ($vendor, $items) {
            $totalSales = $items->sum('subtotal');
            $commission = $items->sum('commission_amount');

            $payout = VendorPayout::create([
                'vendor_id'           => $vendor->id,
                'total_sales'         => $totalSales,
                'commission_deducted' => $commission,
                'payout_amount'       => $totalSales - $commission,
                'status'              => 'pending',
                'period_start'        => $items->min(fn ($item) => $item->order->created_at),
                'period_end'          => now(),
            ]);

            OrderItem::whereIn('id', $items->pluck('id'))->update(['vendor_payout_id' => $payout->id]);

            return $payout;
        });

        return redirect()->route('admin.payouts.history', $vendor)
            ->with('success', 'Payout of Rs. ' . number_format($payout->payout_amount, 2) . " generated for {$vendor->business_name}.");
    }

    public function history(Vendor $vendor): View
    {
        $payouts = $vendor->payouts()->latest()->get();

        return view('admin.payouts.history', compact('vendor', 'payouts'));
    }

    /**
     * Marking paid here does NOT move any real money — it's a record that
     * YOU (the admin) already transferred the amount to the vendor's bank
     * account (bank_name / bank_account_no on the vendor record) outside
     * this system, e.g. via actual bank transfer. Once confirmed, the
     * vendor gets an email receipt so they know to expect the money and
     * can verify the amount matches what they were told.
     */
    public function markPaid(VendorPayout $payout): RedirectResponse
    {
        if ($payout->status === 'paid') {
            return back()->with('error', 'This payout is already marked as paid.');
        }

        $payout->markPaid();

        $vendorEmail = $payout->vendor->user->email ?? null;

        if ($vendorEmail) {
            Mail::to($vendorEmail)->send(new VendorPayoutPaidMail($payout));
        }

        return back()->with('success', 'Marked as paid' .
            ($vendorEmail ? " — a confirmation email was sent to {$payout->vendor->business_name}." : '. No email sent: this vendor has no email on file.'));
    }
}