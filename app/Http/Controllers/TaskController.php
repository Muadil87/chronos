<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display the dashboard with tasks.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('tasks'));
    }

    /**
     * Create a new task (Quick add from Dashboard).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $request->user()->tasks()->create([
            'title' => $validated['title'],
            'is_completed' => false,
            'duration_minutes' => 60, // Default duration
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Show the "Mission Briefing" page.
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Update Task: Handles Dashboard toggles AND Briefing form saves.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Handle the Dashboard Checkbox Toggle
        if ($request->has('is_completed_toggle')) {
            $task->update([
                'is_completed' => $request->boolean('is_completed')
            ]);
            return back();
        }

        // Handle the Mission Briefing Save
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:1',
            'is_completed' => 'nullable|boolean',
        ]);

        $task->update($validated);

        return back()->with('status', 'Mission parameters updated successfully.');
    }

    /**
     * Show the focus/timer page.
     */
    public function focus(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.focus', compact('task'));
    }

    /**
     * Record completed focus time.
     */
    public function recordSession(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'minutes' => 'required|integer|min:1',
        ]);

        $task->increment('time_spent', $validated['minutes']);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a task.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('dashboard');
    }

    /**
     * Stats logic.
     */
    public function stats()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->get();
        $totalMinutes = $tasks->sum('time_spent') ?? 0;
        
        return view('stats', [
            'tasks' => $tasks,
            'totalMinutes' => $totalMinutes,
            'hours' => intdiv($totalMinutes, 60),
            'minutes' => $totalMinutes % 60,
            'completedTasks' => $tasks->where('is_completed', true)->count(),
            'totalTasks' => $tasks->count(),
        ]);
    }
}