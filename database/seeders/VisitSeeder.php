<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        factory(Visit::class, 30)->create();
    }
}
