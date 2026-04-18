<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\SubTask;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    public function store(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->subTasks()->create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return back();
    }

    public function toggleComplete(SubTask $subTask)
    {
        if ($subTask->task->user_id !== auth()->id()) {
            abort(403);
        }

        $subTask->update([
            'is_completed' => !$subTask->is_completed
        ]);

        return back();
    }

    public function destroy(SubTask $subTask)
    {
        if ($subTask->task->user_id !== auth()->id()) {
            abort(403);
        }

        $subTask->delete();
        
        return back();
    }
}
