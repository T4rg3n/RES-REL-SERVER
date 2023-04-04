<?php

namespace Database\Seeders;

use App\Models\Ressource;
use Illuminate\Database\Seeder;

class RessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Ressource::factory()
            ->count(10000)
            ->create();
    }
}
