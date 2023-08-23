<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectedParticipationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data, $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $reason)
    {
        $this->data = $event;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '[ActivEvent] Your Registration For Event "'. $this->data->name .' Has Been Rejected"',
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
            view: 'mail.rejection',
            text: 'mail.rejection-text',
            with: [
                'data' => $this->data,
                'reason' => $this->reason,
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
        $email = $this->view('mail.rejection')
                // ->from('no-reply.activevent@binus.ac.id', 'ActivEvent System')
                ->subject('[ActivEvent] Your Registration For Event "'. $this->data->name .' Has Been Rejected"')
                ->with([
                    'data' => $this->data,
                    'reason' => $this->reason,
                ]);

        return $email;
    }
}
