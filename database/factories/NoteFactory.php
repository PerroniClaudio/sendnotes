<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'title' => $this->faker->words(5, true),
            'body' => $this->faker->paragraph,
            'send_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'is_published' => true,
            'recipient' => $this->faker->email,
            'heart_counter' => $this->faker->numberBetween(0, 100),
        ];
    }
}
