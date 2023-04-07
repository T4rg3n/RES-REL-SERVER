<?php

namespace Tests\Feature;

use App\Models\Role;
use Tests\TestCase;
use App\Models\Utilisateur;

class UtilisateurTest extends TestCase
{
    /**
     * Test POST one utilisateur
     */
    public function testPostOneUtilisateur()
    {
        $response = $this->post('/api/v1/utilisateurs', [
            'nom' => 'test',
            'prenom' => 'test',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae nisl',
            'mail' => 'test@test.com',
            'motDePasse' => 'test*123',
            'dateNaissance' => '1990-01-01 00:00:00',
            'codePostal' => '1234',
            'role' => Role::all()->random()->id_role
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'mail',
            'motDePasse',
            'dateInscription',
            'dateNaissance',
            'codePostal',
            'nom',
            'prenom',
            'cheminPhoto',
            'bio',
            'compteActif',
            'raisonBan',
            'role'
        ]);
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
                    'cheminPhoto',
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
                'cheminPhoto',
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
