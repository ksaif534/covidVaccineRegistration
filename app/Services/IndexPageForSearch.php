<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexPageForSearch
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Index page for Search Functionality
     */
    public function index() : LengthAwarePaginator
    {
        return DB::table('users')
                ->join('vaccine_slots','users.id','=','vaccine_slots.user_id')
                ->select('users.id','users.name','users.registration_status','vaccine_slots.vaccination_date')
                ->orderBy('users.id','asc')
                ->paginate(10);
    }
}
