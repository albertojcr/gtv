<?php

namespace Database\Seeders;

use App\Models\Photography;
use Illuminate\Database\Seeder;

class PhotographySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        factory(Photography::class, 30)->create();
    }
}
