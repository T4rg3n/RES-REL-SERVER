<?php

namespace Tests\Feature;

use App\Models\ReponseCommentaire;
use Tests\TestCase;
use App\Models\Commentaire;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReponseCommentaireTest extends TestCase
{
    use DatabaseTransactions;

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
     * Test POST one reponse commentaire
     */
    public function testPostOneReponseCommentaire()
    {
        $response = $this->post('/api/v1/reponsesCommentaires', [
            'contenu' => 'Test',
            'idCommentaire' => Commentaire::all()->random()->id_commentaire,
            'idUtilisateur' => Utilisateur::all()->random()->id_uti,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'contenu',
            'date',
            'supprime',
            'nombreSignalements',
            'idUtilisateur',
            'idCommentaire',
            'datePublication',
            'reponseSupprime'
        ]);
    }

    /**
     * Test GET all reponse commentaires
     */
    public function testGetAllReponseCommentaires()
    {
        $response = $this->get('/api/v1/reponsesCommentaires');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'contenu',
                    'date',
                    'supprime',
                    'nombreSignalements',
                    'idUtilisateur',
                    'idCommentaire',
                    'datePublication',
                    'reponseSupprime'
                ]
            ]
        ]);
    }

    /**
     * Test GET one reponse commentaire
     */
    public function testGetOneReponseCommentaire()
    {
        $id_reponse = ReponseCommentaire::all()->random()->id_reponse;
        $response = $this->get('/api/v1/reponsesCommentaires/' . $id_reponse);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'contenu',
                'date',
                'supprime',
                'nombreSignalements',
                'idUtilisateur',
                'idCommentaire',
                'datePublication',
                'reponseSupprime'
            ]
        ]);
    }

    /**
     * Test disable one reponse commentaire
     */
    public function testDisableOneReponseCommentaire()
    {
        $id_reponse = ReponseCommentaire::all()->random()->id_reponse;
        $response = $this->patch('/api/v1/reponsesCommentaires/' . $id_reponse . '/disable');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }

    /**
     * Test DELETE one reponse commentaire
     */
    public function testDeleteOneReponseCommentaire()
    {
        $id_reponse = ReponseCommentaire::all()->random()->id_reponse;
        $response = $this->delete('/api/v1/reponsesCommentaires/' . $id_reponse);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }

    /**
     * Test report one reponse commentaire
     */
    public function testReportOneReponseCommentaire()
    {
        $id_reponse = ReponseCommentaire::all()->random()->id_reponse;
        $response = $this->patch('/api/v1/reponsesCommentaires/' . $id_reponse . '/report');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
