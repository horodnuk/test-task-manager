<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\TaskHistory;

class TaskObserver
{
    private const TYPE_CREATED = 'created';

    private const TYPE_UPDATED = 'updated';

    private const TYPE_DELETED = 'deleted';

    public function created(Task $task): void
    {
        $this->createTaskHistory($task, self::TYPE_CREATED);
    }

    public function updated(Task $task): void
    {
        $this->createTaskHistory($task, self::TYPE_UPDATED);
    }

    public function deleted(Task $task): void
    {
        $this->createTaskHistory($task, self::TYPE_DELETED);
    }

    private function createTaskHistory(Task $task, string $type): void
    {
        $taskHistory = new TaskHistory();

        $taskHistory->task_id = $task->id;
        $taskHistory->task_data = $task->toJson();
        $taskHistory->type = $type;

        $taskHistory->save();
    }
}
