<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name"=> "admin",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("admin"),
        ]);

        User::create([
            "name"=> "admin2",
            "email"=> "admin2@gmail.com",
            "password"=> bcrypt("admin"),
        ]);

        $this->call(TaskSeeder::class);

    }
}
