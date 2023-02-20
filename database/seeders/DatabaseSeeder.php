<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            /*CategorieSeeder::class,
            CommentaireSeeder::class,
            FavorisSeeder::class,
            GroupeSeeder::class,
            PieceJointeSeeder::class,*/
            RelationSeeder::class
            /*ReponseCommentaireSeeder::class,
            //RessourceSeeder::class,
            RoleSeeder::class,
            UtilisateurSeeder::class*/
        ]);
    }
}
