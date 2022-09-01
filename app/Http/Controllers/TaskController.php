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

    /**
     */
    public function delete(Task $task)
    {
        $task->delete();

        return back()->with('error', 'Task has been deleted!');
    }

    private function getDate(string $date)
    {
        return \DateTime::createFromFormat('Y-m-d\TG:i', $date);
    }
}
