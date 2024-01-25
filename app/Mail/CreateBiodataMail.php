<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateBiodataMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.biodata-created-reminder')
        ->subject('CHURCH OF CHRIST, KNUST');
    }

   
    // public function attachments(): array
    // {
    //     return [];
    // }
}
