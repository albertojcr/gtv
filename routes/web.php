<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Admin\Photography\Photographies;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::get('/ejemplos', function () {
    return view('ejemplos');
});

Route::get('fotografias', Photographies::class)->name('photographies');
