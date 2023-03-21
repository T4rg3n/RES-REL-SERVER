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
        //TODO maybe more logic for each type of piece jointe
        $pj = $this->faker->randomElement(['IMAGE', 'VIDEO', 'PDF', 'ACTIVITE']);

        if ($pj == 'ACTIVITE') {
            return [
                'type_pj' => $pj,
                'titre_pj' => $this->faker->word,
                'date_creation_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'description_pj' => $this->faker->text,
                'contenu_pj' => $this->faker->text,
                'date_activite_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'lieu_pj' => $this->faker->word,
                'code_postal_pj' => $this->faker->numberBetween(10000, 95000),
                'fk_id_uti' => Utilisateur::all()->random()->id_uti,
            ];
        } else {
            return [
                'type_pj' => $pj,
                'titre_pj' => $this->faker->word,
                'date_creation_pj' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'description_pj' => $this->faker->text(25),
                'contenu_pj' => 'lien vers le fichier sur le serveur',
                'date_activite_pj' => null,
                'lieu_pj' => null,
                'code_postal_pj' => null,
                'fk_id_uti' => Utilisateur::all()->random()->id_uti,
            ];
        }
    }
}
