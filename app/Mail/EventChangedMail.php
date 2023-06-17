<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventChangedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data, $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $status)
    {
        $this->data = $event;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '[ActivEvent] Notice '. $this->status .' For Event "'. $this->data->name .'"',
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
            view: 'mail.update_event',
            text: 'mail.update_event-text',
            with: [
                'data' => $this->data,
                'status' => $this->status,
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
        $email = $this->view('mail.update_event')
                ->subject('[ActivEvent] Notice '. $this->status .' For Event "'. $this->data->name .'"')
                ->with([
                    'data' => $this->data,
                    'status' => $this->status,
                ]);

        return $email;
    }
}
