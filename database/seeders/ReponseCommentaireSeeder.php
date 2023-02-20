<?php

namespace Database\Seeders;

use App\Models\ReponseCommentaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReponseCommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReponseCommentaire::factory()
            ->has(Utilisateur::factory()->count(1))
            ->has(Commentaire::factory()->count(1))
            ->count(10)
            ->create();
    }
}
