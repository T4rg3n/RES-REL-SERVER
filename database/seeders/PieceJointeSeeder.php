<?php

namespace Database\Seeders;

use App\Models\PieceJointe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PieceJointeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PieceJointe::factory()
            ->has(Utilisateur::factory()->count(1))
            ->count(10)
            ->create();
    }
}
