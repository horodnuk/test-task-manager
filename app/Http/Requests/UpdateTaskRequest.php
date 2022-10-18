<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rules\In;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string'],
            'deadline' => [['date', 'date_format:Y-m-d H:i:s']],
            'description' => ['string'],
            'status' => [new In(array_keys(Task::$availableStatuses))],
            'user_id' => ['exists:users,id'],
        ];
    }
}
