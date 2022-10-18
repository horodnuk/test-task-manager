<?php

namespace App\Services;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;

class TaskService extends Controller
{
    public function getTasks(array $filters): TaskCollection
    {
        $filters = $this->prepareFilters($filters);

        return new TaskCollection(Task::where($filters)->paginate());
    }

    public function store(array $payload): TaskResource
    {
        $task = Task::create($payload);

        return new TaskResource($task);
    }

    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    public function update(array $payload, Task $task): TaskResource
    {
        $task->update($payload);

        return new TaskResource($task);
    }

    public function destroy(Task $task): ?bool
    {
        return $task->delete();
    }

    protected function prepareFilters(array $filters): array
    {
        $result = [];
        foreach ($filters as $filterKey => $filterValue) {
            if ('user' === $filterKey) {
                $result[] = ['user_id', '=', $filterValue];
            }
        }

        return $result;
    }
}
