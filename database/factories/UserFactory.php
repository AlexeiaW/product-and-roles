<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(0, 3);

        $roles = ['ROLE_SUBMIT', 'ROLE_APPROVE', 'ROLE_CLIENT', 'ROLE_ADMIN'];

        $email = $this->faker->unique()->safeEmail;

        print "\n";
        print "************\n";
        print "email: " . $email . "\n";
        print "password: password\n";

        return [
            'name' => $this->faker->name,
            'email' => $email,
            'email_verified_at' => now(),
            'roles' => $roles[$rand],
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
