<?php

namespace Database\Seeders;

use App\Models\TypeRelation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesRelations = [
            'Soi',
            'Conjoints',
            'Famille',
            'Professionnel',
            'Amis',
            'Inconnus',
        ];

        foreach($typesRelations as $typeRelation){
            DB::table((new TypeRelation())->getTable())->insert([
                'nom_type_relation' => $typeRelation,
            ]);
        }
    }
}
