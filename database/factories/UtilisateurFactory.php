<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Utilisateur::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_uti' => Utilisateur::factory(),
            'mail_uti' => $this->faker->email,
            'mdp_uti' => $this->faker->password,
            'date_inscription_uti' => now(),
            'date_naissance_uti' => $this->faker->date(),
            'code_postal_uti' => $this->faker->postcode,
            'nom_uti' => $this->faker->lastName,
            'prenom_uti' => $this->faker->firstName,
            'photo_uti' => $this->faker->imageUrl(),
            'bio_uti' => $this->faker->text,
            'url_profil_uti' => $this->faker->url,
            'compte_actif_uti' => true,
            'raison_banni_uti' => $this->faker->sentence,
        ];
    }
}
