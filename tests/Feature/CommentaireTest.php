<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Commentaire;
use App\Models\Utilisateur;
use App\Models\Ressource;
use Tests\TestCase;


class CommentaireTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test POST one comment
     * 
     * @return void
     */
    public function testPostOneCommentaire()
    {
        $id_utilisateur = Utilisateur::all()->random()->id_uti;
        $id_ressource = Ressource::all()->random()->id_ressource;

        $response = $this->post('/api/v1/commentaires', [
            'contenu' => 'Test',
            'idUtilisateur' => $id_utilisateur,
            'idRessource' => $id_ressource,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'contenu',
            'datePublication',
            'nombreReponses',
            'supprime',
            'nombreSignalements',
            'idUtilisateur',
            'idRessource'
        ]);
    }

    /**
     * Test GET all commentaires
     * 
     * @return void
     */
    public function testGetAllCommentaires()
    {
        $response = $this->get('/api/v1/commentaires');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'contenu',
                    'datePublication',
                    'nombreReponses',
                    'supprime',
                    'nombreSignalements',
                    'idUtilisateur',
                    'idRessource'
                ]
            ]
        ]);
    }

    /** 
    * Test GET one commentaire
    * 
    * @return void
    */
    public function testGetOneCommentaire()
    {
        $id_commentaire = Commentaire::all()->random()->id_commentaire;
        $response = $this->get('/api/v1/commentaires/' . $id_commentaire);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'contenu',
                'datePublication',
                'nombreReponses',
                'supprime',
                'nombreSignalements',
                'idUtilisateur',
                'idRessource'
            ]
        ]);
    }

    /**
     * Test disable one commentaire
     */
    public function testDisableOneCommentaire()
    {
        $id_commentaire = Commentaire::all()->random()->id_commentaire;
        $response = $this->patch('/api/v1/commentaires/' . $id_commentaire . '/disable');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }

    /**
     * Test DELETE one commentaire
     */
    public function testDeleteOneCommentaire()
    {
        $id_commentaire = Commentaire::all()->random()->id_commentaire;
        $response = $this->delete('/api/v1/commentaires/' . $id_commentaire);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
