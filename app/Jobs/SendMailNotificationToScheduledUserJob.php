<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\VaccineDateReminder;
use App\Models\User;
use Carbon\Carbon;
use App\UserRegistrationStatusEnum;

class SendMailNotificationToScheduledUserJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::where('registration_status',UserRegistrationStatusEnum::SCHEDULED->value)
                    ->with('vaccine_slot')
                    ->orderBy('created_at','asc')
                    ->chunkById(100, function(Collection $users) {
                        foreach ($users as $user) {
                            $currentTime = Carbon::now();
                            if ($currentTime->diffInHours($user->vaccine_slot->vaccination_date, false) < 24) {
                                Mail::to($user->email)->send(new VaccineDateReminder($user));
                            }
                        }
                    });
    }
}
