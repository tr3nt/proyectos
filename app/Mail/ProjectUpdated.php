<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class ProjectUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance with Project data.
     */
    public function __construct(
        public string $title,
        public string $name,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('esaim.najera@gmail.com', 'Esaim Najera'),
            subject: 'Projects Changed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail',
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
