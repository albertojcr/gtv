<?php

use Illuminate\Database\Seeder;
use App\Visit;
use Illuminate\Support\Str;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
