<?php

namespace App\Jobs;

use App\Mail\EventReminderMail;
use App\Models\Event;
use Carbon\Carbon;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $events = Event::where('status', 'Active')->whereDate('date', '=', Carbon::tomorrow())->get();
        
        foreach ($events as $event) {
            $participants = $event->users()->whereHas('events', function ($q) use ($event) {
                $q->where('id', $event->id)->where('user_event.status', 'Registered');
            })->get();
    
            foreach ($participants as $participant) { //send to every current participants
                Mail::to($participant->email)->send(new EventReminderMail($event));
    
                if($participant->personal_email) {
                    Mail::to($participant->personal_email)->send(new EventReminderMail($event));
                }
            }
        }
    }
}
