<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Admin\Point\ShowPoint;
use App\Http\Livewire\Admin\Video\ListVideos;
use App\Http\Livewire\Admin\VideoItem\ListVideoItems;
use App\Http\Livewire\Admin\Visit\ShowVisits;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/ejemplos', function () {
    return view('ejemplos');
});

Route::get('videos', ListVideos::class)->name('videos.index');
Route::get('video-items', ListVideoItems::class)->name('video-items.index');

Route::get('points-of-interest', ShowPoint::class)->name('points.index');
