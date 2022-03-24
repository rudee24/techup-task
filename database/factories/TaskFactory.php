<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'start_date' => '2022-03-30',
            'due_date' => '2022-04-30',
            'status' => 'New',
            'priority' => 'Medium',
        ];
    }

}

