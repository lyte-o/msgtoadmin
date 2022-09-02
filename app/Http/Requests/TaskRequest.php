<?php

namespace App\Http\Requests;

use App\Helpers\General;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'category'  => ['required', Rule::exists('categories', 'slug')->where('is_active', true)],
            'status'    => ['required', Rule::in(General::STATUSES)],
            'deadline'  => 'required|date'
        ];
    }

    private function updateTask(): array
    {
        return [
            'title'     => 'nullable|string',
            'category'  => 'nullable|exists:categories,slug',
            'status'    => ['required', Rule::in(General::STATUSES)],
            'deadline'  => 'nullable|date'
        ];
    }
}
