<?php

namespace App\Services;
use App\Models\{User,VaccineSlot,VaccineCenter};
use Carbon\Carbon;

class StoreVaccineRegistrationUser
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Store Vaccine Registration User & Configure Vaccine Slot and Center
     */
    public function store(array $validated) : bool
    {
        $vaccineCenter = VaccineCenter::where('id',$validated['center_id'])->first();
        if ($vaccineCenter) {
            $newUser = User::create([
                'vaccine_center_id' => $vaccineCenter->id,
                'nid'               => $validated['nid'],
                'name'              => $validated['name'],
                'email'             => $validated['email']
            ]);
            $newSlot = VaccineSlot::create([
                'user_id'           => $newUser->id,
                'vaccine_center_id' => $vaccineCenter->id
            ]);
            return true;
        }
        return false;
    }
}
