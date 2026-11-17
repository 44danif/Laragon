<?php

namespace Database\Seeders;

use App\Models\tcars;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class tcarsSeeder extends Seeder
{
    public function run(): void
    {
        // Hay que desactivar las claves ajenas para poder vaciar la tabla
        Schema::disableForeignKeyConstraints();
        tcars::truncate();
        Schema::enableForeignKeyConstraints();

        // 1) Seeder "a mano" con bucle
        for ($i = 1; $i <= 10; $i++) {
            tcars::create([
                'plate' => sprintf('%04dAAA', $i),
                'brand' => "Marca$i",
                'model' => "Modelo$i",
                'color' => 'Blanco',
            ]);
        }

        // 2) Seeder con Factory
        tcars::factory(40)->create();
    }
}