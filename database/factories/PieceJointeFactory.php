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
        $typesPj = ['IMAGE', 'VIDEO', 'PDF'];

        return [
            'type_pj' => $typesPj[rand(0,2)],
            'titre_pj' => $this->faker->text,
            'date_creation_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description_pj' => $this->faker->text,
            'contenu_pj' => $this->faker->text,
            'date_activite_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'lieu_pj' => $this->faker->text,
            'code_postal_pj' => $this->faker->text,
            'fk_id_uti' => Utilisateur::all()->random()->id_uti,
        ];
    }
}
