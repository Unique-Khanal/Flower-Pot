<?php

namespace App\Mail;

use App\Models\VendorPayout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorPayoutPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public VendorPayout $payout;

    public function __construct(VendorPayout $payout)
    {
        $this->payout = $payout;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💰 Payout Sent — Rs. ' . number_format($this->payout->payout_amount, 2),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-payout-paid',
        );
    }
}