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

        return view('orders.invoice', [
            'order'    => $order->load('items.vendor'),
            'logoData' => $this->logoDataUri(),
        ]);
    }

    public function download(Order $order): Response
    {
        $this->authorizeAccess($order);

        $pdf = Pdf::loadView('orders.invoice', [
            'order'    => $order->load('items.vendor'),
            'forPdf'   => true,
            'logoData' => $this->logoDataUri(),
        ])->setPaper('a4');

        return $pdf->download("{$order->invoice_no}.pdf");
    }

    /**
     * Embeds the logo as a base64 data URI instead of an asset() URL.
     * DomPDF has no remote file access by default, so a normal
     * http://... image URL silently fails to render in the downloaded
     * PDF even though it displays fine in the browser — embedding the
     * bytes directly makes the web view and the PDF render identically.
     */
    private function logoDataUri(): string
    {
        $path = public_path('images/logo.png');

        if (! file_exists($path)) {
            return '';
        }

        return 'data:image/png;base64,' . base64_encode(file_get_contents($path));
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