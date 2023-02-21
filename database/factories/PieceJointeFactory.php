<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PieceJointe;
use App\Models\Utilisateur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PieceJointe>
 */
class PieceJointeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $incrementingId = 1;

        return [
            'type_piece_jointe' => $this->faker->randomElement('IMAGE', 'VIDEO', 'PDF'),
            'titre_pj' => $this->faker->text,
            'date_creation_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description_pj' => $this->faker->text,
            'contenu_pj' => $this->faker->text,
            'date_activite_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'lieu_pj' => $this->faker->text,
            'code_postal_pj' => $this->faker->text,
            //One to many (user_id exist)
            'fk_id_uti' => $this->faker->unique()->numberBetween(1, Utilisateur::count())
        ];
    }
}
