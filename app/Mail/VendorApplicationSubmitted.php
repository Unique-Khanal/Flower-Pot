<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public Vendor $vendor;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor->loadMissing('user');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Vendor Application — ' . $this->vendor->business_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-application-submitted',
        );
    }
}