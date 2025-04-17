<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::all();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function update($id, array $data)
    {
        $task = Task::find($id);
        if ($task) {
            $task->update($data);
            return $task;
        }
        return null;
    }

    public function delete($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return true;
        }
        return false;
    }

    public function getFilteredTasks($filters)
    {
        return Task::query()
            ->when($filters['status'] ?? null, fn($query, $status) => $query->where('status', $status))
            ->orderBy('due_date', 'asc')
            ->paginate(10);
    }
}
