<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Utilisateur;

class RoleTest extends TestCase
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
     * Test POST one role
     */
    public function testPostOneRole()
    {
        $response = $this->post('/api/v1/roles', [
            'nom' => 'test',
            'ascendant' => 'test',
            'descendant' => 'test',
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'nom',
        ]);
    }

    /**
     * Test GET all roles
     */
    public function testGetAllRoles()
    {
        $response = $this->get('/api/v1/roles');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nom',
                    'ascendant',
                    'descendant',
                ]
            ]
        ]);
    }

    /**
     * Test GET one role
     */
    public function testGetOneRole()
    {
        $id_role = Role::all()->random()->id_role;
        $response = $this->get('/api/v1/roles/' . $id_role);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nom',
                'ascendant',
                'descendant',
            ]
        ]);
    }

    /**
     * Test DELETE one role
     */
    public function testDeleteOneRole()
    {
        $id_role = Role::all()->random()->id_role;
        $response = $this->delete('/api/v1/roles/' . $id_role);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
