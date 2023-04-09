<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Http\Requests\V1\LoginRequest;

class LoginRequestTest extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = $this->createApplication();
    }

    public function testMailIsRequired()
    {
        $data = [
            'mail' => '',
            'motDePasse' => 'password123',
        ];

        $request = new LoginRequest();
        $validator = $this->app['validator']->make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('mail must be a valid email address', $validator->errors()->first('mail'));
    }

    public function testMailMustBeValidEmail()
    {
        $data = [
            'mail' => 'invalid_email',
            'motDePasse' => 'password123',
        ];

        $request = new LoginRequest();
        $validator = $this->app['validator']->make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('mail must be a valid email address', $validator->errors()->first('mail'));
    }

    public function testMailMustNotBeGreaterThan255Characters()
    {
        $data = [
            'mail' => str_repeat('a', 256),
            'motDePasse' => 'password123',
        ];

        $request = new LoginRequest();
        $validator = $this->app['validator']->make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('motDePasse must not be greater than 255 characters', $validator->errors()->first('motDePasse'));
        $this->assertEquals('mail must not be greater than 255 characters', $validator->errors()->first('mail'));
    }

    public function testMotDePasseIsRequired()
    {
        $data = [
            'mail' => 'test@example.com',
            'motDePasse' => '',
        ];

        $request = new LoginRequest();
        $validator = $this->app['validator']->make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('motDePasse is required', $validator->errors()->first('motDePasse'));
    }

    public function testMotDePasseMustBeAtLeast8Characters()
    {
        $data = [
            'mail' => 'test@example.com',
            'motDePasse' => '1234567',
        ];

        $request = new LoginRequest();
        $validator = $this->app['validator']->make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('motDePasse must be at least 8 characters', $validator->errors()->first('motDePasse'));
    }

    public function testMotDePasseMustNotBeGreaterThan255Characters()
    {
        $data = [
            'mail' => 'test@example.com',
            'motDePasse' => str_repeat('a', 256),
        ];

        $request = new LoginRequest();
        $validator = $this->app['validator']->make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertEquals('motDePasse must not be greater than 255 characters', $validator->errors()->first('motDePasse'));
    }
}
