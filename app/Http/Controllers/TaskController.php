<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        $this->authorize($task);

        return view('task.show', compact('task'));
    }

    public function delete(Task $task)
    {
        $this->authorize($task);

        $task->deleteOrFail();

        return redirect(route('task.index'));
    }

    public function store(TaskStoreRequest $request) : RedirectResponse
    {
        auth()->user()->tasks()->create($request->validated());

        return redirect(route('task.index'));
    }

    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(10);

        return view('task.index', [
            'tasks' => $tasks
        ]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorize($task);

        $task->update(
            $request->validated()
        );

        return redirect(route('task.show', $task->id));
    }

    public function create()
    {
        return view('task.create');
    }

    public function edit(Task $task)
    {
        $this->authorize($task);
        return view('task.edit', compact('task'));
    }
}
