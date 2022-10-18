<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'deadline' => $this->deadline->format('d-m-Y H:i:s'),
            'description' => $this->description,
            'status' => Task::$availableStatuses[$this->status],
            'user' => new UserResource($this->user),
            'created' => $this->created_at->format('d-m-Y H:i:s'),
            'updated' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
