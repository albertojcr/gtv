<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Video;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $places = Place::all();

        return view('welcome', compact('places'));
    }
}
