<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndSearchController;

Route::get('/', function () {
    return to_route('register');
});

Route::group(['prefix' => 'user'], function() {
    Route::get('register', [RegisterAndSearchController::class,'create'])->name('register');
    Route::post('store',[RegisterAndSearchController::class,'store'])->name('user.store');
    Route::get('index',[RegisterAndSearchController::class,'index'])->name('user.index');
    Route::get('search',[RegisterAndSearchController::class,'search'])->name('user.search');
});