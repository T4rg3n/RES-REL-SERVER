<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * Test POST one role
     */
    public function testPostOneRole()
    {
        $response = $this->post('/api/v1/roles', [
            'nom' => 'test',
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
