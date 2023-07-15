<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('position')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function reorder(Request $request)
    {
        $taskIds = $request->input('taskIds');

        foreach ($taskIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['position' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
