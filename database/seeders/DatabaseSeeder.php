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
            PieceJointeSeeder::class,
            RessourceSeeder::class,
            CommentaireSeeder::class,
            TypeRelationSeeder::class,
            ReponseCommentaireSeeder::class,
            FavorisSeeder::class,
        ]);
    }
}
