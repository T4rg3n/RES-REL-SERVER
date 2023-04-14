<?php

namespace Tests\Feature;

use App\Models\Role;
use Tests\TestCase;
use App\Models\Utilisateur;

class UtilisateurTest extends TestCase
{
    /**
     * Set up authentication for the test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $user = Utilisateur::factory()->create();

        $this->actingAs($user);
    }

    /**
     * Test GET all utilisateurs
     */
    public function testGetAllUtilisateurs()
    {
        $response = $this->get('/api/v1/utilisateurs');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'mail',
                    'motDePasse',
                    'dateInscription',
                    'dateNaissance',
                    'codePostal',
                    'nom',
                    'prenom',
                    'bio',
                    'compteActif',
                    'raisonBan',
                    'role'
                ]
            ]
        ]);
    }

    /**
     * Test GET one utilisateur
     */
    public function testGetOneUtilisateur()
    {
        $id_utilisateur = Utilisateur::all()->random()->id_uti;
        $response = $this->get('/api/v1/utilisateurs/' . $id_utilisateur);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'mail',
                'motDePasse',
                'dateInscription',
                'dateNaissance',
                'codePostal',
                'nom',
                'prenom',
                'bio',
                'compteActif',
                'raisonBan',
                'role'
            ]
        ]);
    }

    /**
     * Test DELETE one utilisateur
     */
    public function testDeleteOneUtilisateur()
    {
        $id_utilisateur = Utilisateur::all()->random()->id_uti;
        $response = $this->delete('/api/v1/utilisateurs/' . $id_utilisateur);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
