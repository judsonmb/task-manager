<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function getFilteredTasks(array $filters);
}
