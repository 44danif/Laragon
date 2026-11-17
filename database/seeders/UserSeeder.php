<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create(['name' => 'admin', 'email' => 'admin@admin.com']);
        User::factory(10)->create();
    }
}