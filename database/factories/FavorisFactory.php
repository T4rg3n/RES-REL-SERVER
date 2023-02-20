<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favoris>
 */
class FavorisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_favoris' => Favoris::factory(),
            'date_fav' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'fk_id_uti' => function () {
                return factory(Utilisateur::class)->create()->id_uti;
            },
            'fk_id_uti' => function () {
                return factory(Ressource::class)->create()->id_ressource;
            }
        ];
    }
}
