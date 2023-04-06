<?php

namespace Database\Seeders;

use App\Models\Commentaire;
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
            ->count(10000)
            ->create();
    }
}
