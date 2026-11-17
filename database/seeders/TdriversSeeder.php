<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tdrivers;

class TdriversSeeder extends Seeder
{
  
    public function run(): void
    {
        tdrivers::factory(10)->create();
    }
}
