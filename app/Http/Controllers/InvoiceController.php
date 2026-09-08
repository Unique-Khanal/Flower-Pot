<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show(Order $order): View
    {
        $this->authorizeAccess($order);

        return view('orders.invoice', ['order' => $order->load('items.vendor')]);
    }

    public function download(Order $order): Response
    {
        $this->authorizeAccess($order);

        $pdf = Pdf::loadView('orders.invoice', [
            'order' => $order->load('items.vendor'),
            'forPdf' => true,
        ])->setPaper('a4');

        return $pdf->download("{$order->invoice_no}.pdf");
    }

    private function authorizeAccess(Order $order): void
    {
        $user = Auth::user();
        $isOwner = $order->user_id === $user->id;
        $isAdmin = $user->role === 'admin';

        abort_unless($isOwner || $isAdmin, 403);

        abort_if(
            $order->payment_status !== 'paid' || ! $order->invoice_no,
            404,
            'Invoice is available once payment for this order has been confirmed.'
        );
    }
}