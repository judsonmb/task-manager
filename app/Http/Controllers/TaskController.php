<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct(protected TaskService $service) {}

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'tasks' => $this->service->listTasks($request->only('status'))
            ]);
        }
    
        return Inertia::render('TaskList', [
            'tasks' => $this->service->listTasks($request->only('status'))
        ]);
    }

    public function store(TaskRequest $request)
    {
        $this->service->createTask($request->validated());

        return Inertia::location(route('tasks.index'));
    }
}