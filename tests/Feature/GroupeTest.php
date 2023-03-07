<?php

namespace Tests\Feature;

use App\Models\Groupe;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GroupeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test POST one group
     * 
     * @return void
     */
    public function testPostOneGroup()
    {
        $response = $this->post('/api/v1/groupes', [
            'nom' => 'Test',
            'description' => 'Test',
            'estPrive' => '0'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'nom',
            'description'
        ]);
    }

    /**
     * Test GET all groups
     */
    public function testGetAllGroups()
    {
        $response = $this->get('/api/v1/groupes');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nom',
                    'description',
                    'estPrive'
                ]
            ]
        ]);
    }

    /**
     * Test GET one group
     */
    public function testGetOneGroup()
    {
        $id_groupe = Groupe::all()->random()->id_groupe;
        $response = $this->get('/api/v1/groupes/' . $id_groupe);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nom',
                'description',
                'estPrive'
            ]
        ]);
    }

    /**
     * Test DELETE one group
     */
    public function testDeleteOneGroup()
    {
        $id_groupe = Groupe::all()->random()->id_groupe;
        $response = $this->delete('/api/v1/groupes/' . $id_groupe);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
