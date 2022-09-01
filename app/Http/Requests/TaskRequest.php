<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return $this->routeIs('tasks.store') ?
            $this->newTask() : $this->updateTask();
    }

    private function newTask(): array
    {
        return [
            'title'     => 'required|string',
            'category'  => 'required|exists:categories,slug',
            'status'    => 'required|in:ONGOING,NOT STARTED',
            'deadline'  => 'required|date'
        ];
    }

    private function updateTask(): array
    {
        return [];
    }
}
