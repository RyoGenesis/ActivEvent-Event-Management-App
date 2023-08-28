<?php

namespace App\Mail;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event as ComponentsEvent;
use Spatie\IcalendarGenerator\Properties\TextProperty;

class RegisterEventMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data, $calendar;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $emailTarget)
    {
        $this->data = $event;

        $this->calendar = Calendar::create()
            ->productIdentifier('ActivEvent')
            ->event(function (ComponentsEvent $eventComp) use ($event, $emailTarget) {
                $eventComp->name($event->name)
                    ->attendee($emailTarget)
                    ->startsAt(Carbon::parse($event->date)) //ex format: 2021-12-15 08:00:00
                    ->fullDay()
                    ->address($event->location);
            });
        $this->calendar->appendProperty(TextProperty::create('METHOD', 'REQUEST'));
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
        return [
            Attachment::fromData(fn () => $this->calendar->get(), 'invite.ics')
                ->withMime('text/calendar; charset=UTF-8; method=REQUEST'),
        ];
    }

    public function build()
    {
        $email = $this->view('mail.register_event')
                // ->from('no-reply.activevent@binus.ac.id', 'ActivEvent System')
                ->attachData($this->calendar->get(),'invite.ics', [
                    'mime' => 'text/calendar; charset=UTF-8; method=REQUEST',
                ])
                ->subject('[ActivEvent] Successful Registration To Event "'. $this->data->name .'"')
                ->with([
                    'data' => $this->data,
                ]);

        return $email;
    }
}
