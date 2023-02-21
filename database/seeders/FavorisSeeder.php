<?php

namespace Database\Seeders;

use App\Models\Favoris;
use Illuminate\Database\Seeder;

class FavorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favoris::factory()
            ->count(10)
            ->create();
    }
}
