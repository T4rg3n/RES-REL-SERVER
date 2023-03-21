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
            RoleSeeder::class,
            UtilisateurSeeder::class,
            GroupeSeeder::class,
            CategorieSeeder::class,
            TypeRelationSeeder::class,
            RelationSeeder::class,
            PieceJointeSeeder::class,
            RessourceSeeder::class,
            CommentaireSeeder::class,
            ReponseCommentaireSeeder::class,
            FavorisSeeder::class,
        ]);
    }
}
