<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TypeRelation;

class TypeRelationTest extends TestCase
{
    /**
     * Test POST one typeRelation
     */
    public function testPostOneTypeRelation()
    {
        $response = $this->post('/api/v1/typesRelation', [
            'nom' => 'test'
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'nom',
            'dateCreation'
        ]);
    }

    /**
     * Test GET all typeRelations
     */
    public function testGetAllTypeRelations()
    {
        $response = $this->get('/api/v1/typesRelation');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nom',
                    'dateCreation'
                ]
            ]
        ]);
    }

    /**
     * Test GET one typeRelation
     */
    public function testGetOneTypeRelation()
    {
        $id_type_relation = TypeRelation::all()->random()->id_type_relation;
        $response = $this->get('/api/v1/typesRelation/' . $id_type_relation);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nom',
                'dateCreation'
            ]
        ]);
    }

    /**
     * Test DELETE one typeRelation
     */
    public function testDeleteOneTypeRelation()
    {
        $id_type_relation = TypeRelation::all()->random()->id_type_relation;
        $response = $this->delete('/api/v1/typesRelation/' . $id_type_relation);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
