<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $visits = factory(Visit::class, 30)->make();
        $visits->each(function($v) {
            $v->url = Str::slug($v->deviceid);
            $v->save();
        });
    }
}
