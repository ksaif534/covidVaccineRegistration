<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchForUserWithNID
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Search for a user with nation Id input
     */
    public function search(array $validated) : LengthAwarePaginator
    {
        if ($validated['search']) {
            return DB::table('users')
                ->where('nid', $validated['search'])
                ->select('id','name','registration_status')
                ->paginate(10);
        }
        return DB::table('users')
            ->select('id','name','registration_status')
            ->paginate(10);
    }
}
