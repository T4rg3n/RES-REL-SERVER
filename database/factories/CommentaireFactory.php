<?php

namespace Database\Factories;

use App\Models\Ressource;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contenu_commentaire' => $this->faker->text,
            'date_publication_commentaire' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'nombre_reponses_commentaire' => $this->faker->randomNumber(2),
            'commentaire_supprime' => $this->faker->boolean,
            'nombre_signalement_commentaire' => $this->faker->randomNumber(2),
            'fk_id_uti' => $this->faker->unique()->numberBetween(1, Utilisateur::count()),
            'fk_id_ressource' => $this->faker->unique()->numberBetween(1, Ressource::count())
        ];
    }
}
