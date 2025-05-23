<?php

namespace App\Mail;

use App\Models\Gaji;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class GajiBayarMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gaji;
    public $buktiTransfer;

    public function __construct(Gaji $gaji, $buktiTransfer)
    {
        $this->gaji = $gaji;
        $this->buktiTransfer = $buktiTransfer;
    }

    public function build()
    {
        return $this->subject('Rincian Pembayaran Gaji')
            ->view('gaji.mail')
            ->with([
                'gaji' => $this->gaji,
                'buktiTransfer' => $this->buktiTransfer,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Gaji Bayar Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'gaji.mail',
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
