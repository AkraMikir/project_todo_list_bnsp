<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $query = $user->tasks()->with('category', 'subTasks')
            ->orderByRaw('due_datetime IS NULL, due_datetime ASC')
            ->orderBy('priority', 'asc');
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->get();
        // Separate today and others for the index view
        $todayTasks = $tasks->filter(function($task) {
            return $task->due_datetime && $task->due_datetime->isToday();
        });
        
        $completedTasks = $tasks->where('is_completed', true);

        return view('tasks.index', compact('tasks', 'todayTasks', 'completedTasks'));
    }

    public function calendar(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        /** @var \App\Models\User $user */
        $user = $request->user();
        $tasks = $user->tasks()
            ->with('category')
            ->whereDate('due_datetime', $date)
            ->orderBy('due_datetime', 'asc')
            ->get();

        return view('calendar.index', compact('tasks', 'date'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'nullable|integer|between:1,3',
            'date_input' => 'nullable|date',
            'time_input' => 'nullable|string',
            'deadline_date' => 'nullable|date',
            'deadline_time' => 'nullable|string',
        ]);

        $due_datetime = null;
        if (!empty($validated['date_input']) && !empty($validated['time_input'])) {
            $due_datetime = Carbon::parse($validated['date_input'] . ' ' . $validated['time_input']);
        } elseif (!empty($validated['date_input'])) {
            $due_datetime = Carbon::parse($validated['date_input']);
        }

        $deadline = null;
        if (!empty($validated['deadline_date']) && !empty($validated['deadline_time'])) {
            $deadline = Carbon::parse($validated['deadline_date'] . ' ' . $validated['deadline_time']);
        } elseif (!empty($validated['deadline_date'])) {
            $deadline = Carbon::parse($validated['deadline_date']);
        }

        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'priority' => $validated['priority'] ?? 2,
            'due_datetime' => $due_datetime,
            'deadline' => $deadline,
        ]);

        return back()->with('success', 'Task created successfully');
    }

    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) abort(403);
        $task->load('category', 'subTasks');
        return view('tasks.show', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'nullable|integer|between:1,3',
            'date_input' => 'nullable|date',
            'time_input' => 'nullable|string',
            'deadline_date' => 'nullable|date',
            'deadline_time' => 'nullable|string',
        ]);

        $updateData = collect($validated)->except(['date_input', 'time_input', 'deadline_date', 'deadline_time'])->toArray();

        if (isset($validated['date_input']) && isset($validated['time_input'])) {
            $updateData['due_datetime'] = Carbon::parse($validated['date_input'] . ' ' . $validated['time_input']);
        } elseif (isset($validated['date_input'])) {
            $updateData['due_datetime'] = Carbon::parse($validated['date_input']);
        }

        if (isset($validated['deadline_date']) && isset($validated['deadline_time'])) {
            $updateData['deadline'] = Carbon::parse($validated['deadline_date'] . ' ' . $validated['deadline_time']);
        } elseif (isset($validated['deadline_date'])) {
            $updateData['deadline'] = Carbon::parse($validated['deadline_date']);
        }

        $task->update($updateData);

        return back()->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) abort(403);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }

    public function toggleComplete(Task $task)
    {
        if ($task->user_id !== Auth::id()) abort(403);
        $task->update(['is_completed' => !$task->is_completed]);
        return back();
    }
}
