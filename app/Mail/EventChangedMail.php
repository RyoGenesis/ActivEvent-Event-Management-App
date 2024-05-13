<?php

namespace App\Mail;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event as ComponentsEvent;
use Spatie\IcalendarGenerator\Properties\TextProperty;

class EventChangedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data, $status, $calendar;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $status, $emailTarget)
    {
        $this->data = $event;
        $this->status = $status;

        if($this->status == 'Update') {
            $this->calendar = Calendar::create()
                ->productIdentifier('ActivEvent')
                ->event(function (ComponentsEvent $eventComp) use ($event, $emailTarget) {
                    $eventComp->name($event->name)
                        ->attendee($emailTarget)
                        ->startsAt(Carbon::parse($event->date))
                        ->fullDay()
                        ->address($event->location);
                });
            $this->calendar->appendProperty(TextProperty::create('METHOD', 'REQUEST'));
        }
    }

    // /**
    //  * Get the message envelope.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Envelope
    //  */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: '[ActivEvent] Notice '. $this->status .' For Event "'. $this->data->name .'"',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Content
    //  */
    // public function content()
    // {
    //     return new Content(
    //         view: 'mail.update_event',
    //         // text: 'mail.update_event-text',
    //         with: [
    //             'data' => $this->data,
    //             'status' => $this->status,
    //         ],
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array
    //  */
    // public function attachments()
    // {
    //     return [
    //         Attachment::fromData(fn () => $this->calendar->get(), 'invite.ics')
    //             ->withMime('text/calendar; charset=UTF-8; method=REQUEST'),
    //     ];
    // }

    public function build()
    {
        $email = $this->view('mail.update_event')
                ->subject('[ActivEvent] Notice '. $this->status .' For Event "'. $this->data->name .'"')
                ->with([
                    'data' => $this->data,
                    'status' => $this->status,
                ]);

        if($this->status == 'Update') {
            $email->attachData($this->calendar->get(),'invite.ics', [
                'mime' => 'text/calendar; charset=UTF-8; method=REQUEST',
            ]);
        }

        return $email;
    }
}
