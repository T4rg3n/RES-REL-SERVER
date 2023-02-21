<?php

namespace Database\Seeders;

use App\Models\PieceJointe;
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
            ->count(250)
            ->create();
    }
}
