<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rules\In;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'deadline' => ['required', ['date', 'date_format:Y-m-d H:i:s']],
            'description' => ['required', 'string'],
            'status' => [new In(array_keys(Task::$availableStatuses))],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
