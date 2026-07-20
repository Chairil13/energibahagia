<?php

namespace App\Mail;

use App\Models\Donasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public Donasi $donasi;

    public function __construct(Donasi $donasi)
    {
        $this->donasi = $donasi->loadMissing(['program', 'bank']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Donasi Anda Ditolak - Energi Bahagia',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.donation-cancelled',
        );
    }
}
