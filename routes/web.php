<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Admin\Visit\ShowVisits;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::get('/ejemplos', function () {
    return view('ejemplos');
});


Route::get('visits', ShowVisits::class)->name('admin.visits.show');
