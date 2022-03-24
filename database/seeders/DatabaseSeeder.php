<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
            ]
        );
        \App\Models\Task::factory()->count(1)->create()->each(function ($task) {
            $note=\App\Models\Note::factory()->count(1)->make();
            $task->notes()->saveMany($note);
        });
    }
}
