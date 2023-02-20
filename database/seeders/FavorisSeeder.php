<?php

namespace Database\Seeders;

use App\Models\Favoris;
use App\Models\Utilisateur;
use App\Models\Ressource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->has(Utilisateur::factory()->count(1))
            ->has(Ressource::factory()->count(1))
            ->count(10)
            ->create();
    }
}
