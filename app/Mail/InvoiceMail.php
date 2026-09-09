<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order->loadMissing('items.vendor');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Invoice ' . $this->order->invoice_no . ' — Biruwa',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
        );
    }

    public function attachments(): array
    {
        $path = public_path('images/logo.png');

        $pdf = Pdf::loadView('orders.invoice', [
            'order'    => $this->order,
            'forPdf'   => true,
            'logoData' => file_exists($path)
                ? 'data:image/png;base64,' . base64_encode(file_get_contents($path))
                : '',
        ])->setPaper('a4');

        return [
            Attachment::fromData(fn () => $pdf->output(), $this->order->invoice_no . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}