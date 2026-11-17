<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            tcarsSeeder::class,
            tdriversSeeder::class,
            trevisionsSeeder::class,
            tcardriversSeeder::class,
            UserSeeder::class,
        ]);
    }
}