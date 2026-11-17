<?php

namespace Database\Factories;

use App\Models\tdrivers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<tdrivers>
 */
class TdriversFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $crcMap = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];
    $number = fake()->unique()->numerify('########');
    $dni = $number . $crcMap[$number % 23];

    return [
        'nom'     => fake()->firstName(),
        'cognoms' => fake()->lastName(),
        'dni'     => $dni,
        'telefon' => fake()->numerify('6########'),
    ];
    }
}
