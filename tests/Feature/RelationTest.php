<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Utilisateur;
use App\Models\Relation;

class RelationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *  Test POST one relation 
     */
    public function testPostOneRelation()
    {
        $response = $this->post('/api/v1/relations', [
            'idDemandeur' => Utilisateur::all()->random()->id_uti,
            'idReceveur' => Utilisateur::all()->random()->id_uti,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'idDemandeur',
            'idReceveur',
            'accepte'
        ]);
    }

    /**
     * Test GET all relations
     */
    public function testGetAllRelations()
    {
        $response = $this->get('/api/v1/relations');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'idDemandeur',
                    'idReceveur',
                    'accepte'
                ]
            ]
        ]);
    }

    /**
     * Test GET one relation
     */
    public function testGetOneRelation()
    {
        $id_relation = Relation::all()->random()->id_relation;
        $response = $this->get('/api/v1/relations/' . $id_relation);
        $response->assertStatus(200);
        $response->assertJsonStructure([
          'data' => [
            'id',
            'idDemandeur',
            'idReceveur',
            'accepte'
            ]
        ]);
    }

    /**
     * Test DELETE one relation
     */
    public function testDeleteOneRelation()
    {
        $id_relation = Relation::all()->random()->id_relation;
        $response = $this->delete('/api/v1/relations/' . $id_relation);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
