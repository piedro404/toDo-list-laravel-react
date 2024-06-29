<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->boolean();
        return [
            'title' => fake()->name(),
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'status' => $status,
            'concluied_at' => $status ? $this->faker->randomElement([$this->faker->dateTimeThisMonth()]) : null,
            'deadline' => now()->addDays(7),
            'user_id' => User::all()->random()->id,
        ];
    }
}
