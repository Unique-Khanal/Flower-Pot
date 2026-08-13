<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        // Load items (and each item's vendor, for the "sold by" line on the slip)
        $this->order = $order->loadMissing('items.vendor');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmed — #' . str_pad($this->order->id, 6, '0', STR_PAD_LEFT) . ' | Biruwa',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
        );
    }
}