<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testViewLogin()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_with_correct_credentials()
    {

        $this->withoutMiddleware();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);
    }

    function redirect_to_home_dashboard_and_logged_in_after_register()
    {
        $response = $this->post('register', [
            'name' => 'Test',
            'email' => 'test@hotmail.com',
            'password' => '123456'
        ]);

        //this works
        $response->assertRedirect('/dashboard');

        //this fails 
        $this->assertTrue(Auth::check());
    }
}
