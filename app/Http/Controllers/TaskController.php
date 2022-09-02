<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->get();

        return view('pages.tasks', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('pages.new-task', compact('categories'));
    }

    public function store(TaskRequest $request)
    {
        try {
            $data = $request->only('title', 'status');
            $data['deadline'] = $this->getDate($request->deadline);
            $data['slug'] = genUniqueSlug($request->title);

            $category = Category::slug($request->category)->first();
            $data['category_id'] = $category->id;

            auth()->user()->tasks()->create($data);

            return redirect()->route('tasks.index')->with('success', 'New task created!');
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

    public function edit(Task $task)
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('pages.edit-task', compact('task', 'categories'));
    }

    public function update(Task $task, TaskRequest $request)
    {
        try {
            $update = $request->only('title', 'status');

            $update['deadline'] = $this->getDate($request->deadline);

            $category = Category::slug($request->category)->first();
            $update['category_id'] = $category->id;

            $update_data = $this->getUpdateData(request_data: $update, current_task: $task);

            if (!empty($update_data)) {
                $task->update($update);
                return redirect()->route('tasks.index')->with('success', 'Task Updated!');
            }
            else {
                return back()->with('status', 'You have not made any changes.');
            }
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

    /**
     */
    public function delete(Task $task)
    {
        $task->delete();

        return back()->with('error', 'Task has been deleted!');
    }

    private function getDate(string $date)
    {
        return Carbon::createFromFormat('Y-m-d\TG:i', $date);
    }


    /**
     * Check if values are similar and return the subsequent array difference
     *
     * @param array $request_data update values for the task table
     * @param Task $current_task exiting table row to be updated
     * @return array
     */
    private function getUpdateData(array $request_data, Task $current_task): array
    {
        $task = $current_task->only('title', 'status', 'category_id', 'deadline');

        foreach ($request_data as $key => $value) {
            if (is_null($value)) {
                unset($task[$key]);
                unset($request_data[$key]);
            }
        }

        return array_diff_assoc($task, $request_data);
    }
}
