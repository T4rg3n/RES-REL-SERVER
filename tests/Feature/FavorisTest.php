<?php

namespace Tests\Feature;

use App\Models\Favoris;
use App\Models\Ressource;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FavorisTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test POST one favoris
     * 
     * @return void
     */
    public function testPostOneFavoris()
    {
        $response = $this->post('/api/v1/favoris', [
            'idUtilisateur' => Utilisateur::all()->random()->id_uti,
            'idRessource' => Ressource::all()->random()->id_ressource,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'dateFav',
            'idUtilisateur',
            'idRessource'
        ]);
    }

    /**
     * Test GET all favoris
     */
    public function testGetAllFavoris()
    {
        $response = $this->get('/api/v1/favoris');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'dateFav',
                    'idUtilisateur',
                    'idRessource'
                ]
            ]
        ]);
    }

    /**
     * Test GET one favoris
     */
    public function testGetOneFavoris()
    {
        $id_favoris = Favoris::all()->random()->id_favoris;
        $response = $this->get('/api/v1/favoris/' . $id_favoris);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'dateFav',
                'idUtilisateur',
                'idRessource'
            ]
        ]);
    }

    /**
     * Test DELETE one favoris
     */
    public function testDeleteOneFavoris()
    {
        $id_favoris = Favoris::all()->random()->id_favoris;
        $response = $this->delete('/api/v1/favoris/' . $id_favoris);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
