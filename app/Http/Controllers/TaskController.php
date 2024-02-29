<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): TaskCollection
    {
        if (request()->input('status')){
            $statusName = request()->input('status');
            $status = Status::where('name', $statusName)->first();
            return new TaskCollection(Task::where('status_id',  $status->id)->get());
        }

        if (request()->input('due_date')){
            return new TaskCollection(Task::where('due_date',  request()->input('due_date'))->get());
        }
        if (request()->input('due_date_greater_than')){
            return new TaskCollection(Task::where('due_date','>=',  request()->input('due_date_greater_than'))->get());
        }
        if (request()->input('due_date_less_than')){
            return new TaskCollection(Task::where('due_date','<=',  request()->input('due_date_less_than'))->get());
        }
        return new TaskCollection(Task::all());
    }

    public function store(Request $request): JsonResponse
    {
        $statusName = $request->input('status');
        $status = Status::where('name', $statusName)->first();

        if (!$status) {
            return response()->json(['error' => 'Status not found'], 404);
        }

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status_id' => $status->id,
            'due_date' => $request->input('due_date')
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Task created',
        ],201);
    }

    public function show(Task $task): TaskResource|JsonResponse
    {
        try {
            return new TaskResource($task);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Task not found'
            ],404);
        }
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $statusName = $request->input('status');
        $status = Status::where('name', $statusName)->first();
        $task->update([
            'title' => $request->input('title') ?? $task['title'],
            'description' => $request->input('description') ?? $task['description'],
            'status_id' => $status->id ?? $task['status_id'],
            'due_date' => $request->input('due_date') ?? $task['due_date']
        ]);
        return response()->json($task, 200);
    }

    public function destroy(Task $task): JsonResponse
    {
        try {
            if ($task->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Task deleted'
                ],204);
            }
            return response()->json([
                'status' => 'failed',
                'message' => 'Could not delete task'
            ], 404);

        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Task not found'
            ],404);
        }
    }

}
