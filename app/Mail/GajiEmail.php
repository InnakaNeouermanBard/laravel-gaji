<?php

namespace App\Mail;

use App\Models\Transaksi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GajiEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $transaksi;
    /**
     * Create a new message instance.
     */
    public function __construct(Transaksi $transaksi)
    {
        //
        $this->transaksi = $transaksi;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Rincian Pembayaran Gaji')
            ->view('gaji.mail')
            ->with([
                'transaksi' => $this->transaksi,
            ]);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Gaji Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
