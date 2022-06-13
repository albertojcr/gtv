<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Admin\ThematicArea\ThematicAreas;
use App\Http\Livewire\Admin\Video\ListVideos;
use App\Http\Livewire\Admin\VideoItem\ListVideoItems;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/ejemplos', function () {
    return view('ejemplos');
});

Route::get('videos', ListVideos::class)->name('videos.index');
Route::get('video-items', ListVideoItems::class)->name('video-items.index');

Route::get('areas-tematicas', ThematicAreas::class)->name('thematic-areas');

