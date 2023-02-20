<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\Role;
use App\Models\Groupe;
use App\Models\Ressource;
use App\Models\Favoris;
use App\Models\Commentaire;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Utilisateur::factory()
            ->count(100)
            ->has(Role::factory()->count(1))
            ->has(Groupe::factory()->count(1))
            ->has(Ressource::factory()->count(20))
            ->has(Favoris::factory()->count(10))
            ->has(Commentaire::factory()->count(5))
            ->create();
    }
}
