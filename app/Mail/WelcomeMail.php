<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Karyawan;
use App\Models\Gaji;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gaji;

    /**
     * Create a new message instance.
     *
     * @param Gaji $gaji
     */
    public function __construct(Gaji $gaji)
    {
        $this->gaji = $gaji;
    }


    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Pembayaran Gaji')
            ->view('gaji.mail')
            ->with([
                'karyawan' => $this->gaji->karyawan->nama_karyawan,
                'periode' => $this->gaji->periode_gaji,
                'totalGaji' => $this->gaji->gaji_pokok + $this->gaji->total_bonus - $this->gaji->potongan_gaji,
            ]);
    }
}
