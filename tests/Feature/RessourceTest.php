<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Ressource;
use Tests\TestCase;


class RessourceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test POST one ressource 
     */
    public function testPostOneRessource()
    {
        $response = $this->post('/api/v1/ressources', [
            'titre' => 'test',
            'contenu' => 'test',
            'idUtilisateur' => Utilisateur::all()->random()->id_uti,
            'idCategorie' => Categorie::all()->random()->id_categorie
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'dateCreation',
            'status',
            'idUtilisateur',
            'partage',
            'titre',
            'contenu',
            'datePublication',
            'raisonRefus',
            'idCategorie'
        ]);

    }

    /**
     * Test GET all ressources
     */
    public function testGetAllRessources()
    {
        $response = $this->get('/api/v1/ressources');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'dateCreation',
                    'status',
                    'idUtilisateur',
                    'partage',
                    'titre',
                    'contenu',
                    'datePublication',
                    'raisonRefus',
                    'idCategorie'
                ]
            ]
        ]);
    }

    /**
     * Test GET one ressource
     */
    public function testGetOneRessource()
    {
        $id_ressource = Categorie::all()->random()->id_categorie;
        $response = $this->get('/api/v1/ressources/' . $id_ressource);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'dateCreation',
                'status',
                'idUtilisateur',
                'partage',
                'titre',
                'contenu',
                'datePublication',
                'raisonRefus',
                'idCategorie'
            ]
        ]);
    }

    /**
     * Test disable one ressource
     */
    public function testDisableOneRessource()
    {
        $pendingIds = Ressource::where('status', '=', 'PENDING')->select('id_ressource')->get()->pluck('id_ressource');
        $id_ressource = $pendingIds->random();

        $response = $this->patch('/api/v1/ressources/disable', [
            'id' => $id_ressource,
            'raison' => 'test'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }

    /**
     * Test delete one favoris
     */
    public function testDeleteOneRessource()
    {
        $id_ressource = Categorie::all()->random()->id_categorie;
        $response = $this->delete('/api/v1/ressources/' . $id_ressource);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
