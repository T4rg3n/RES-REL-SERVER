<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Ressource;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::factory()
            ->has(Ressource::factory()->count(10))
            ->count(10)
            ->create();
    }
}
