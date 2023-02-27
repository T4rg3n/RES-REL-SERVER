<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utilisateur;
use App\Models\Categorie;
use App\Models\PieceJointe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ressource>
 */
class RessourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [    
            'date_creation_ressource' => now(),
            'status' => $this->faker->randomElement(['PENDING', 'APPROVED', 'REJECTED', 'DELETED']),
            'fk_id_uti' => Utilisateur::all()->random()->id_uti,
            'partage_ressource' => $this->faker->randomElement(['PRIVATE', 'PUBLIC', 'RESTRICTED']),
            'titre_ressource' => $this->faker->sentence,
            'contenu_texte_ressource' => $this->faker->text,
            'date_publication_ressource' => $this->faker->dateTime(),
            'fk_id_categorie' => Categorie::all()->random()->id_categorie,
            'fk_id_piece_jointe' => PieceJointe::all()->random()->id_piece_jointe,
        ];
    }
}
