<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Utilisateur;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $banStatus = $this->faker->boolean;
        if($banStatus)
            $raisonBan = $this->faker->text;
            
        return [
            'mail_uti' => $this->faker->email,
            'mdp_uti' => Hash::make($this->faker->password),
            'date_inscription_uti' => $this->faker->date(),
            'date_naissance_uti' => $this->faker->date(),
            'code_postal_uti' => $this->faker->postcode,
            'nom_uti' => $this->faker->lastName,
            'prenom_uti' => $this->faker->firstName,
            'photo_uti' => 'fake user photo',
            'bio_uti' => $this->faker->text,
            'compte_actif_uti' => $this->faker->boolean,
            'raison_banni_uti' => $banStatus ? $raisonBan : null,
            'fk_id_role' => Role::all()->random()->id_role,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Utilisateur $utilisateur) {
            $utilisateur->url_profil_uti = public_path() . '//user-files/' . $utilisateur->id_uti . '/';
        });
    }
}
