<?php

namespace App\Jobs;

use App\Mail\EventChangedMail;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailEventChanged implements ShouldQueue
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
            Mail::to($participant->email)->send(new EventChangedMail($event, 'Update', $participant->email));
            //send WA notification WIP
        }
    }
}
