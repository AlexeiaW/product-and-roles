<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAuthUserCanSubmit()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
            'roles' => "ROLE_SUBMIT",
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->get('/auth-token');

        $token = $response['token'];

        $response = $this->call('POST', '/api/products', ['name' => 'test', 'published' => '0'], [], [], ['HTTP_Authorization' => "Bearer " . $token]);

        $response->getContent();
        $this->assertEquals('Success', $response->getContent());
    }

    public function testAuthUserApprove()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
            'roles' => "ROLE_APPROVE",
        ]);

        $products = Products::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->get('/auth-token');

        $token = $response['token'];

        $response = $this->call('GET', '/api/products/1', [], [], [], ['HTTP_Authorization' => "Bearer " . $token]);

        $this->assertEquals($response['id'], 1);

        $response = $this->call('PUT', '/api/products/1', ['name' => 'test', 'published' => '1'], [], [], ['HTTP_Authorization' => "Bearer " . $token]);

        $response->getContent();
        $this->assertEquals('Success', $response->getContent());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAuthUserCanSeeApproved()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
            'roles' => "ROLE_CLIENT",
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->get('/auth-token');

        $token = $response['token'];

        $response = $this->call('GET', '/api/approved-products', [], [], [], ['HTTP_Authorization' => "Bearer " . $token]);

        $this->assertNotEmpty($response[0]['id']);
    }
}
