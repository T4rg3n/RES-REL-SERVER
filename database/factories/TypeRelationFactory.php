<?php

namespace Database\Factories;

use App\Models\TypeRelation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeRelation>
 */
class TypeRelationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom_type_relation' => $this->faker->word,
            'date_creation' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
