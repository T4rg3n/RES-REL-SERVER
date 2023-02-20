<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ressource;
use App\Models\Utilisateur;
use App\Models\Categorie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ressource>
 */
class RessourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ressource::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_ress' => Ressource::factory(),
            'date_creation_ressource' => now(),
            'status' => $this->faker->randomElement(['PENDING', 'APPROVED', 'REJECTED', 'DELETED']),
            'fk_id_uti' => function () {
                return factory(Utilisateur::class)->create()->id_uti;
            },
            'partage_ressource' => $this->faker->word,
            'titre_ressource' => $this->faker->sentence,
            'contenu_texte_ressource' => $this->faker->text,
            'date_publication_ressource' => $this->faker->dateTime(),
            'raison_refus_ressource' => $this->faker->sentence,
            'fk_id_categorie' => function () {
                return factory(Categorie::class)->create()->id_categorie;
            }
        ];
    }
}
