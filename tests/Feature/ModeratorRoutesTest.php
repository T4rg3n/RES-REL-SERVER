<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Commentaire;

class ModeratorRoutesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp():void
    {
        parent::setUp();

        $moderator = Utilisateur::factory()->create([
            'fk_id_role' => '3',
        ]);

        $this->actingAs($moderator);
    }

    public function TestModeratorCanAccessModeratorRoutes()
    {
        //Commentaire not banned
        $idCommentaire = Commentaire::where('commentaire_supprime', false)->first()->id_commentaire;

        $response = $this->patch('/api/v1/commentaires/' . $idCommentaire . '/disable');

        $response->assertStatus(200);
    }
}
