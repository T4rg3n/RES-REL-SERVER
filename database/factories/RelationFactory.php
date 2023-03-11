<?php

namespace Database\Factories;

use App\Models\Relation;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relation>
 */
class RelationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'demandeur_id' => Utilisateur::all()->random()->id_uti,
            'receveur_id' => Utilisateur::all()->random()->id_uti,
            'accepte' => $this->faker->randomElement([null, true, false]),
            //'date_acceptation' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'date_acceptation' => $this->faker->randomElement([$this->faker->dateTimeBetween('-1 year', 'now'), null]),
            'date_demande' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
