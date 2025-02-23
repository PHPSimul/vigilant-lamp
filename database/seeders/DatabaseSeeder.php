<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\ServerService;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $serverService = new ServerService();
        $serverService->createServer(User::first());
    }
}
