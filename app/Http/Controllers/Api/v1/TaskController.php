<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request): JsonResponse
    {
        $response = $this->taskService->getTasks($request->query->all());

        return new JsonResponse($response);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $response = $this->taskService->store($request->validated());

        return new JsonResponse($response);
    }

    public function show(int $taskId): JsonResponse
    {
        $task = Task::findOrFail($taskId);

        $response = $this->taskService->show($task);

        return new JsonResponse($response);
    }

    public function update(UpdateTaskRequest $request, int $taskId): JsonResponse
    {
        $task = Task::findOrFail($taskId);

        $response = $this->taskService->update($request->validated(), $task);

        return new JsonResponse($response);
    }

    public function destroy(int $taskId): JsonResponse
    {
        $task = Task::findOrFail($taskId);

        $this->taskService->destroy($task);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
