<?php

namespace App\Jobs;

use App\Mail\WaitingApprovalMail;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ApprovalRequestReminder implements ShouldQueue
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
        $superadmins = ladmin()->admin()->whereHas('roles', function ($q) {
            $q->where('id',1); //superadmin role ID
        })->get();

        foreach ($superadmins as $superadmin) { //send to every super admin about a new event waiting to be approved
            Mail::to($superadmin->email)->send(new WaitingApprovalMail($this->event));
        }
    }
}
