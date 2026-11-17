<?php

namespace Database\Factories;

use App\Models\tcars;
use App\Models\trevisions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<trevisions>
 */
class TrevisionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'plate'      => tcars::inRandomOrder()->first()->plate,
        'data'       => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        'descripcio' => fake()->randomElement(['Canvi d\'oli', 'Frens', 'Pneumàtics', 'ITV', 'Revisió general', 'Bateria']),
        'cost'       => fake()->randomFloat(2, 30, 900),
        ];
    }
}
