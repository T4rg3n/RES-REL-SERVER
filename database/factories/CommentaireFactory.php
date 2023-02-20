<?php

namespace Database\Factories;

use App\Models\Commentaire;
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
            'id_commentaire' => Commentaire::factory(),
            'contenu_commentaire' => $this->faker->text,
            'date_publication_commentaire' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'nombre_reponses_commentaire' => $this->faker->randomNumber(2),
            'commentaire_supprime' => $this->faker->boolean,
            'nombre_signalement_commentaire' => $this->faker->randomNumber(2),
            'fk_id_uti' => function () {
                return factory(Utilisateur::class)->create()->id_uti;
            },
            'fk_id_uti' => function () {
                return factory(Ressource::class)->create()->id_ressource;
            }
        ];
    }
}
