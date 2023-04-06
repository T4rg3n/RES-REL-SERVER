<?php

namespace Database\Seeders;

use App\Models\ReponseCommentaire;
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
            ->count(10000)
            ->create();
    }
}
