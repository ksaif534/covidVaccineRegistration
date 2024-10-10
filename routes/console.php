<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Scheduling\Schedule as ScheduleDay;
use App\Jobs\AssignVaccineSlotJob;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:assign-vaccine-slot')->everyThreeHours()->days([ScheduleDay::SUNDAY,ScheduleDay::MONDAY,ScheduleDay::TUESDAY,ScheduleDay::WEDNESDAY,ScheduleDay::THURSDAY]);
Schedule::command('app:send-mail-notification-to-scheduled-user')->dailyAt('21:00')->days([ScheduleDay::SATURDAY,ScheduleDay::SUNDAY,ScheduleDay::MONDAY,ScheduleDay::TUESDAY,ScheduleDay::WEDNESDAY]);
