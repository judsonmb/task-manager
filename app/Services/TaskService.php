<?php

namespace App\Services;

use App\Repositories\TaskRepositoryInterface;

class TaskService
{
    public function __construct(protected TaskRepositoryInterface $repository) {}

    public function listTasks(array $filters)
    {
        return $this->repository->getFilteredTasks($filters);
    }

    public function createTask(array $data)
    {
        return $this->repository->create($data);
    }
}
