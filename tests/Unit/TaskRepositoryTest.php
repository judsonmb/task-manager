<?php

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns tasks filtered by status', function () {
    Task::factory()->create(['status' => 'pending']);
    Task::factory()->create(['status' => 'completed']);

    $repository = new TaskRepository();
    $tasks = $repository->getFilteredTasks(['status' => 'pending']);

    expect($tasks)->toHaveCount(1);
    expect($tasks->first()->status)->toBe('pending');
});

it('paginates the task results', function () {
    Task::factory()->count(30)->create();

    $repository = new TaskRepository();
    $tasks = $repository->getFilteredTasks([]);

    expect($tasks->perPage())->toBe(10);
    expect($tasks->total())->toBe(30);
});

it('creates a new task', function () {
    $repository = new TaskRepository();
    $data = [
        'title' => 'Repository Created Task',
        'description' => 'Created from repository',
        'due_date' => now()->addDays(7)->format('Y-m-d'),
        'priority' => 'medium',
        'status' => 'pending',
    ];

    $task = $repository->create($data);

    expect($task)->toBeInstanceOf(Task::class);
    $this->assertDatabaseHas('tasks', [
        'title' => 'Repository Created Task',
    ]);
});
