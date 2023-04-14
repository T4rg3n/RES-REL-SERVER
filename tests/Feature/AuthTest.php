<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    protected string $testMail = 'john.doe@domain.com';
    protected string $testPassword = 'password01';
    protected string $token = '';

    /**
     * Test successful user registration.
     *
     * @return void
     */
    public function testRegistrationSuccess()
    {
        $testMail = $this->testMail;
        $testPassword = $this->testPassword;

        Storage::fake('uploads');

        $photo = UploadedFile::fake()->image('profile_picture_resrel.jpg');

        $response = $this->post('/api/v1/inscription', [
            'mail' => $testMail,
            'motDePasse' => $testPassword,
            'dateNaissance' => '2002-01-02 00:00:00',
            'codePostal' => '75000',
            'nom' => 'Doe',
            'prenom' => 'John',
            'photoProfil' => $photo,
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['response', 'token']);

        $responseBody = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('id', $responseBody['response']);
        $this->assertArrayHasKey('mail', $responseBody['response']);
        $this->assertArrayHasKey('dateInscription', $responseBody['response']);
        $this->assertArrayHasKey('dateNaissance', $responseBody['response']);
        $this->assertArrayHasKey('codePostal', $responseBody['response']);
        $this->assertArrayHasKey('nom', $responseBody['response']);
        $this->assertArrayHasKey('prenom', $responseBody['response']);
        $this->assertArrayHasKey('bio', $responseBody['response']);
        $this->assertArrayHasKey('compteActif', $responseBody['response']);
        $this->assertArrayHasKey('raisonBan', $responseBody['response']);
        $this->assertArrayHasKey('idRole', $responseBody['response']);

        $this->assertNotEmpty($responseBody['token']);
    }

    /**
     * Test failed login with incorrect credentials.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        $mail = $this->testMail;

        $response = $this->json('POST', '/api/v1/connexion', [
            'mail' => $mail,
            'motDePasse' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test successful login.
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $this->testRegistrationSuccess();

        $testMail = $this->testMail;
        $testPassword = $this->testPassword;

        $response = $this->json('POST', '/api/v1/connexion', [
            'mail' => $testMail,
            'motDePasse' => $testPassword,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'idUti']);
    }

    //TODO disconnect

    /*
    TestAuthenticationFailedMissingToken: This test should check if the API returns a 401 error when the user sends a request without a valid bearer token.

    TestAuthenticationFailedExpiredToken: This test should check if the API returns a 401 error when the user sends a request with an expired bearer token.

    TestAuthorizationFailed: This test should check if the API returns a 403 error when the user tries to access a resource that they are not authorized to access, such as an endpoint that requires an admin role.
    */
}