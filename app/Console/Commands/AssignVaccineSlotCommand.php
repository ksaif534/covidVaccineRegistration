<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use App\Jobs\AssignVaccineSlotJob;

class AssignVaccineSlotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-vaccine-slot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign Vaccine Slot if Vaccine Center Limit is not crossed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        AssignVaccineSlotJob::dispatchSync();
    }
}
