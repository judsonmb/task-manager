<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays paginated list of tasks', function () {
    Task::factory()->count(25)->create();

    $response = $this->get(route('tasks.index'));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->component('TaskList')
             ->has('tasks.data', 10)
    );
});

it('filters tasks by status', function () {
    Task::factory()->create(['status' => 'pending']);
    Task::factory()->create(['status' => 'completed']);

    $response = $this->get(route('tasks.index', ['status' => 'pending']));

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) =>
        $page->where('tasks.data.0.status', 'pending')
    );
});

it('creates a task successfully', function () {
    $data = [
        'title' => 'New Task',
        'description' => 'This is a new task',
        'due_date' => now()->addDays(5)->format('Y-m-d'),
        'priority' => 'high',
    ];

    $response = $this->post(route('tasks.store'), $data);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
    ]);
});

it('validates input when creating a task', function () {
    $response = $this->post(route('tasks.store'), []);

    $response->assertSessionHasErrors(['title', 'priority']);
});
