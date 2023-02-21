<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Relation;
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
            'demandeur_id' => $this->faker->randomNumber(2),
            'receveur_id' => $this->faker->randomNumber(2),
            'accepte' => $this->faker->boolean
        ];
    }
}
