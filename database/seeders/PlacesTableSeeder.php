<?php

namespace Database\Seeders;

use App\Place;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $places = factory(Place::class,10)->create();
        $places->each(function($p) {
            $p->url = Str::slug($p->name);
            $p->save();
            $user = User::all()->pluck('id')->toArray();
            $p->users()->attach(Arr::random($user, 2));
        });
    }
}
