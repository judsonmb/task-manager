<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $statuses = ['pending', 'in_progress', 'completed'];

        foreach (range(1, 50) as $index) {
            Task::create([
                'title' => $faker->sentence(5),
                'description' => $faker->paragraph(),
                'status' => $statuses[array_rand($statuses)],
                'due_date' => $faker->dateTimeBetween('now', '+1 month'),
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
            ]);
        }
    }
}
