<?php

namespace Tests\Feature;

use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class PieceJointeTest extends TestCase
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
     * Test POST one piece jointe (Image)
     */
    public function testPostOneImageAsPieceJointe()
    {
        Storage::fake('public');
        $id_utilisateur = Utilisateur::all()->random()->id_uti;

        $response = $this->post('/api/v1/piecesJointes', [
            'file' => UploadedFile::fake()->image('photo1.jpg'),
            'type' => 'IMAGE',
            'titre' => 'Image',
            'idUtilisateur' => $id_utilisateur,
            'description' => 'Test Image',
        ]);

        $response->assertFileExists(Storage::disk('public/user-files/' . $id_utilisateur . '/image')->exists('photo1.jpg'));
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'type',
            'titre',
            'dateCreation',
            'description',
            'contenu',
            'dateActivite',
            'lieu',
            'codePostal',
            'utilisateur'
        ]);
    }
}
