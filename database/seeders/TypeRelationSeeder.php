<?php

namespace Database\Seeders;

use App\Models\TypeRelation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeRelation::factory()
            ->count(5)
            ->create();
    }
}
