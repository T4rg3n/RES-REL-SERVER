<?php

namespace Database\Seeders;

//use App\Models\Commentaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commentaire::factory()
            /* ChatGPT said it was not necessary to create a user and a resource for each comment
            ->has(Utilisateur::factory()->count(1))
            ->has(Ressource::factory()->count(1))*/
            ->count(10)
            ->create();
    }
}
