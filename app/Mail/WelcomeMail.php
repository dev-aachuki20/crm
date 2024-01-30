<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $fullname;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct($fullname, $password)
    {
        $this->fullname = $fullname;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content(view: 'emails.user-register'))
            ->with('fullname', $this->fullname)
            ->with('password', $this->password);
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

    /* public function build()
    {
        return $this->subject('Welcome Mail')
            ->view('emails.user-register', ['fullname' => $this->fullname, 'email' => $this->email, 'password' => $this->password]);
    } */
}
