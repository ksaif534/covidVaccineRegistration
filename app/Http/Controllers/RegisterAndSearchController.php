<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GetAvailableVaccineCenters;
use App\Http\Requests\{StoreVaccineRegistrationUserRequest,SearchForUserNIDRequest};
use App\Services\{StoreVaccineRegistrationUser,IndexPageForSearch,SearchForUserWithNID};

class RegisterAndSearchController extends Controller
{
    /**
     * Index Page for Search Functionality
     */
    public function index(IndexPageForSearch $indexPage)
    {
        $users = $indexPage->index();
        return view('user.index',compact('users'));
    }

    /**
     * User Registration Form Page
     */
    public function create(GetAvailableVaccineCenters $vaccineCenters)
    {
        $vaccineCenters = $vaccineCenters->fetch();
        return view('user.register',compact('vaccineCenters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVaccineRegistrationUserRequest $request, StoreVaccineRegistrationUser $storeUser)
    {
        $validated  = $request->validated();
        $response   = $storeUser->store($validated);
        if ($response) {
            return back()->with(['msg' => 'User Registered Successfully. You will soon receive the vaccination date schedule']);
        }
        return back()->with(['msg' => 'Sorry, user not registered. Please try again']);
    }

    /**
     * Search for User(s) with NID
     */
    public function search(SearchForUserNIDRequest $request, SearchForUserWithNID $searchNID)
    {
        $validated = $request->validated();
        $users = $searchNID->search($validated);
        return view('user.index')->with(['msg' => 'These are the Search Results','users' => $users]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
