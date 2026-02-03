<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // 1. Validate: Make sure they actually typed something
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // 2. Create: Save the task to the database
        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(), // Assign it to the CURRENT user (You!)
        ]);

        // 3. Redirect: Go back to the dashboard so they see the new task
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Security: Ensure only the owner can see this
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Return the new view (we will create this file next)
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if we are just toggling "Done/Undone" (from the dashboard)
        if ($request->has('toggle_completion')) {
             $task->update(['is_completed' => !$task->is_completed]);
             return redirect()->back();
        }

        // Otherwise, we are updating the Details (Time Goal, Title, etc.)
        $task->update($request->only(['title', 'description', 'time_goal']));

        // Stay on the same page and show a success message
        return redirect()->route('tasks.show', $task)->with('status', 'Goal updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Task $task)
    {
        // 1. Security Check: Make sure the user owns this task
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. Delete it
        $task->delete();

        // 3. Go back to the dashboard
        return redirect()->route('dashboard');
    }
    public function focus(Task $task)
{
    if ($task->user_id !== Auth::id()) abort(403);

    // Return the simple timer page (we will build this file in the next prompt)
    return "Welcome to the Focus Room for: " . $task->title; 
}
}
