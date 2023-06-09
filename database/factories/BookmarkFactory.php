<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utilisateur;
use App\Models\Ressource;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_bookmark' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'fk_id_uti' => Utilisateur::all()->random()->id_uti,
            'fk_id_ressource' => Ressource::all()->random()->id_ressource,
        ];
    }
}
