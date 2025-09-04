<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    const TASKS_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'query' => 'nullable',
            'status' => 'nullable|in:all,pending,completed'
        ]);
        $query = $request->input('query');
        $status = $request->input('status');
        $tasks = Task::query();
        if ($query) {
            $tasks = $tasks->where('title', 'like', '%' . $query . '%');
        }
        if ($status) {
            if ($status != 'all') {
                $tasks = $tasks->where('status', '=', $status);
            }
        }
        $tasks = $tasks->orderBy('created_at', 'desc')->paginate(TaskController::TASKS_PER_PAGE);

        return view('tasks/index', ['tasks' => $tasks, 'query' => $query, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        return view('tasks/form', ['task' => $task]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:255',
            'status' => 'required|in:pending,completed'
        ]);

        Task::create($validated);
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks/show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks/form', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:255',
            'status' => 'required|in:pending,completed'
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);
        $task->save();
        return redirect(route('tasks.index'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:pending,completed'
        ]);
        $task->update($validated);
        $task->save();
        return redirect(route('tasks.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
