<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Admin\Photography\Photographies;
use App\Http\Livewire\Admin\Places\ListPlaces;
use App\Http\Livewire\Admin\ThematicArea\ThematicAreas;
use App\Http\Livewire\Admin\User\ListUsers;
use App\Http\Livewire\Admin\Video\ListVideos;
use App\Http\Livewire\Admin\VideoItem\ListVideoItems;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('fotografias', Photographies::class)->name('photographies.index');

Route::get('videos', ListVideos::class)->name('videos.index');
Route::get('video-items', ListVideoItems::class)->name('video-items.index');
Route::get('users', ListUsers::class)->name('users.index');
Route::get('areas-tematicas', ThematicAreas::class)->name('thematic-areas.index');
Route::get('places', ListPlaces::class)->name('places.index');
