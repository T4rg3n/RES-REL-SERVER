<?php

namespace Database\Seeders;

use App\Models\Ressource;
use App\Models\Categorie;
use App\Models\Utilisateur;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->count(100)
            ->has(Categorie::factory()->count(1))
            ->has(Utilisateur::factory()->count(1))
            ->create();
    }
}
