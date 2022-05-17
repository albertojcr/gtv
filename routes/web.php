<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Admin\Video\ShowVideos;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/ejemplos', function () {
    return view('ejemplos');
});

Route::get('videos', ShowVideos::class)->name('videos.show');
