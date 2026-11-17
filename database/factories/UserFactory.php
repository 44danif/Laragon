<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name'              => fake()->unique()->userName(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('12345678'),
            'rol'               => 'usuari',
            'remember_token'    => Str::random(10),
        ];
    }

    // Uso: User::factory()->admin()->create()
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => ['rol' => 'admin']);
    }
}