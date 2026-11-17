<?php

namespace Database\Factories;

use App\Models\tcars;
use Illuminate\Database\Eloquent\Factories\Factory;

class tcarsFactory extends Factory
{
    protected $model = tcars::class;

    public function definition(): array
    {
        $catalogo = [
            'Seat'       => ['Ibiza', 'Leon', 'Arona', 'Ateca'],
            'Renault'    => ['Clio', 'Megane', 'Captur'],
            'Volkswagen' => ['Golf', 'Polo', 'Tiguan'],
            'Toyota'     => ['Corolla', 'Yaris', 'RAV4'],
            'Ford'       => ['Fiesta', 'Focus', 'Kuga'],
            'Peugeot'    => ['208', '308', '2008'],
        ];

        $brand = fake()->randomElement(array_keys($catalogo));

        return [
            'plate' => strtoupper(fake()->unique()->bothify('####???')), // 7 caracteres
            'brand' => $brand,
            'model' => fake()->randomElement($catalogo[$brand]),
            'color' => fake()->randomElement(['Blanco', 'Negro', 'Rojo', 'Azul', 'Gris', 'Verde']),
        ];
    }
}