<?php

namespace Database\Seeders;

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
            UtilisateurSeeder::class,
            RoleSeeder::class,
            GroupeSeeder::class,
            CategorieSeeder::class,
            RelationSeeder::class,
            RessourceSeeder::class,
            TypeRelationSeeder::class,
            CommentaireSeeder::class,
            ReponseCommentaireSeeder::class,
            PieceJointeSeeder::class,
            FavorisSeeder::class,
        ]);
    }
}
