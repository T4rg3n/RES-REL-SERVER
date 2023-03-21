<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Communication',
            'Culture',
            'Développement personnel',
            'Intelligence émotionnelle',
            'Loisirs',
            'Monde professionnel',
            'Parentalité',
            'Qualité de vie',
            'Recherche de sens',
            'Santé physique',
            'Santé psychique',
            'Spiritualité',
            'Vie affective',
        ];

        foreach($categories as $categorie){
            DB::table((new Categorie())->getTable())->insert([
                'nom_categorie' => $categorie,
            ]);
        }
    }
}
