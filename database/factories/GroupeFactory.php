<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Groupe>
 */
class GroupeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_groupe' => Groupe::factory(),
            'nom_groupe' => $this->faker->text,
            'description_groupe' => $this->faker->text,
            'est_prive_groupe' => $this->faker->boolean
        ];
    }
}
