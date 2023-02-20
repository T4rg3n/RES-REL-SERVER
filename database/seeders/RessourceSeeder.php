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
        /*  1. Ressource::factory() is the model of the table "ressources"
            2. count(100) means that 100 ressources will be created
            3. has(Categorie::factory()->count(1)) means that for each ressource, one category will be created
            4. has(Utilisateur::factory()->count(1)) means that for each ressource, one user will be created
            5. create() is a method of the Laravel Eloquent ORM */
       Ressource::factory()
            ->count(100)
            ->has(Categorie::factory()->count(1))
            ->has(Utilisateur::factory()->count(1))
            ->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
