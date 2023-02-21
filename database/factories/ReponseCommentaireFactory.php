<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReponseCommentaire>
 */
class ReponseCommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contenu_reponse' => $this->faker->text,
            'date_publication_reponse' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'reponse_supprime' => $this->faker->boolean,
            'nombre_signalement_commentaire' => $this->faker->randomNumber(2),
            'fk_id_uti' => $this->faker->randomNumber(2),
            'fk_id_commentaire' => $this->faker->randomNumber(2)
        ];
    }
}
