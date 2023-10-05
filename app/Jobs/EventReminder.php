<?php

namespace App\Jobs;

use App\Mail\EventReminderMail;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class EventReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = $this->event;
        $participants = $event->users()->whereHas('events', function ($q) use ($event) {
            $q->where('id', $event->id)->where('user_event.status', 'Registered');
        })->get();

        foreach ($participants as $participant) { //send to every current participants
            Mail::to($participant->email)->send(new EventReminderMail($event));
            //send WA notification WIP
            $twilio = new Client(getenv('TWILIO_ACCOUNT_SID'),getenv('TWILIO_AUTH_TOKEN'));

            $twilio->messages->create('whatssapp:'. $participant->phone,[
                'from'=>'whatsapp' . getenv('TWILIO_WHATSAPP_NUMBER'),
                'body'=>'Halo' . $participant->name . ', pesan ini merupakan pesan pengingat partisipasi anda di acara' . $event->name . 'Yang akan dilaksanakan pada' .$event->date,
            ]);
        }
    }
}
