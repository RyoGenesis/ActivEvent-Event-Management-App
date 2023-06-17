<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterEventMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->data = $event;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            // from: new Address('no-reply.activevent@binus.ac.id', 'ActivEvent System'),
            subject: '[ActivEvent] Successful Registration To Event "'. $this->data->name .'"',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.register_event',
            text: 'mail.register_event-text',
            with: [
                'data' => $this->data,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    public function build()
    {
        $email = $this->view('mail.register_event')
                // ->from('no-reply.activevent@binus.ac.id', 'ActivEvent System')
                ->subject('[ActivEvent] Successful Registration To Event "'. $this->data->name .'"')
                ->with([
                    'data' => $this->data,
                ]);

        return $email;
    }
}
