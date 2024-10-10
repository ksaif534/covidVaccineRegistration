<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{User,VaccineSlot};
use Carbon\Carbon;
use App\UserRegistrationStatusEnum;

class AssignVaccineSlotJob implements ShouldQueue
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
        $last24Hours = Carbon::now()->subHours(24);
        $availableNumberOfDailyUsersForSchedule = User::where('registration_status',UserRegistrationStatusEnum::NOT_SCHEDULED->value)
                                                ->where('created_at','>=',$last24Hours)
                                                ->count();
        $users = User::where('registration_status',UserRegistrationStatusEnum::NOT_SCHEDULED->value)
                ->with('vaccine_center')
                ->chunkById(100, function(Collection $users) use ($availableNumberOfDailyUsersForSchedule) {
                    $availableSlots = VaccineSlot::orderBy('created_at', 'asc')
                                    ->take($users->count())
                                    ->get();
                    if ($availableSlots->isEmpty()) {
                        return;
                    }
                    $slotIds = [];
                    $userIds = [];
                    foreach ($users as $index => $user) {
                        if ($user->vaccine_center->center_limit >= $availableNumberOfDailyUsersForSchedule) {
                            if (isset($availableSlots[$index])) {
                                $slot = $availableSlots[$index];
                                $slotIds[] = [
                                    'id'                => $slot->id
                                ];
                                $userIds[] = [
                                    'id'                => $user->id
                                ];
                            }
                        }
                    }
                    VaccineSlot::whereIn('id',$slotIds)->update([
                        'vaccination_date'          => Carbon::now()->addDays(rand(0,30))
                    ]);
                    User::whereIn('id',$userIds)->update([
                        'registration_status'       => UserRegistrationStatusEnum::SCHEDULED->value
                    ]);
                });
    }
}
