<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tcars;
use App\Models\tdrivers;
use App\Models\tcardrivers;

class TcardriversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $drivers = tdrivers::pluck('id');

        foreach (tcars::pluck('plate') as $plate) {
            foreach ($drivers->random(rand(1, 3)) as $id) {
                tcardrivers::create(['plate' => $plate, 'driver_id' => $id]);
            }
        }
    }
}
