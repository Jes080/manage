<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $title = "Task Management";
        return view('pages.taskfunc', compact('tasks', 'title'));

    }

    public function create(Task $task)
    {
        return view('taskfunc.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due' => 'required|date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Not Started,In Progress,Completed',
        ]);

        // Create a new task using the validated data
        Task::create($validatedData);

        return redirect('/taskfunc')->with('success', 'Task created successfully!');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('task.show', compact('task'));
    }

    public function update(Request $request, $id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due' => 'required|date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Not Started,In Progress,Completed',
        ]);

        // Update the task with the validated data
        $task->update($validatedData);

        return redirect('/taskfunc')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/taskfunc')->with('success', 'Task deleted successfully!');
    }
}
