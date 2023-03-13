<?php

namespace Tests\Feature;

use App\Models\Categorie;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategorieTest extends TestCase
{
    //Revert changes mades by the tests
    use DatabaseTransactions;

    //TODO Add test for ?perPage

    /**
     * Test POST one category
     *
     * @return void
     */
    public function testPostOneCategory()
    {
        $response = $this->post('/api/v1/categories', [
            'nom' => 'Test'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'nom'
        ]);
    }

    /**
     * Test GET all categories
     *
     * @return void
     */
    public function testGetAllCategories()
    {
        $response = $this->get('/api/v1/categories');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nom'
                ]
            ]
        ]);
    }

    /**
     * Test GET one category
     *
     * @return void
     */
    public function testGetOneCategory()
    {
        $category = Categorie::find(1);
        $response = $this->get('/api/v1/categories/' . $category->id_categorie);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nom'
            ]
        ]);
    }

    
    /**
     * Test DELETE one category
     */
    public function testDeleteOneCategory()
    {
        $category = Categorie::find(1);
        $response = $this->delete('/api/v1/categories/' . $category->id_categorie);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message'
        ]);
    }
}
