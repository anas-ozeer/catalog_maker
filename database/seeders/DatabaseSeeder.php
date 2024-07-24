<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        // $user = User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create a catalog associated with the test user
        Catalog::create([
            'user_id' => $user->id,
            'name' => 'Test Catalog',
            'description' => 'Test Description'
            // Add other required fields here
        ]);
    }
}
