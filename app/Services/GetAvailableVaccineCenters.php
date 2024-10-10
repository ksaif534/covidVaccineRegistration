<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;
use App\Models\VaccineCenter;

class GetAvailableVaccineCenters
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get All Available Vaccine Centers
     */
    public function fetch() : Collection
    {
        return VaccineCenter::all();
    }
}
