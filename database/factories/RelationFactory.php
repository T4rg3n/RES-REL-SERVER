<?php

namespace Database\Factories;

use App\Models\TypeRelation;
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
        $accepte = $this->faker->randomElement([null, true, false]);

        if($accepte === null || $accepte === false)
            $dateAcceptation = null;
        else
            $dateAcceptation = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'demandeur_id' => Utilisateur::all()->random()->id_uti,
            'receveur_id' => Utilisateur::all()->random()->id_uti,
            'accepte' => $accepte,
            'fk_id_type_relation' => TypeRelation::all()->random()->id_type_relation,
            'date_acceptation' => $dateAcceptation,
            'date_demande' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
