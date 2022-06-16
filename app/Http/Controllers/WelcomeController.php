<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Video;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}
