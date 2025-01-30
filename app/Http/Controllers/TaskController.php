<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display list of tasks for the logged-in user
    public function index()
    {
        $tasks = auth()->user()->tasks;  // Retrieve tasks for the logged-in user
        
        return view('tasks.index', compact('tasks'));
    }

    // Show the form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store a new task in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Show a specific task's details
    public function show(Task $task)
    {
        $this->authorize('view', $task); // Ensure the task belongs to the logged-in user
        return view('tasks.show', compact('task'));
    }

    // Show the form to edit an existing task
    public function edit(Task $task)
    {
        $this->authorize('update', $task); // Ensure the task belongs to the logged-in user
        return view('tasks.edit', compact('task'));
    }

    // Update an existing task in the database
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task); // Ensure the task belongs to the logged-in user

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_completed' => $request->has('is_completed'), // handle checkbox for completion
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Delete a task from the database
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task); // Ensure the task belongs to the logged-in user
        
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
