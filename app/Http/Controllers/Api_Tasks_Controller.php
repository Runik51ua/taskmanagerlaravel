<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Task_Model;
use App\User;
use Illuminate\Http\Request;

class Api_Tasks_Controller extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return Task_Model::with(['subtask' => function ($q) {
                $q->orderBy('priority');
            }])->get();;
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

    public function show($id)
    {
        if (auth()->user()) {
            $task = Task_Model::with(['subtask' => function ($q) {
                $q->orderBy('priority');
            }])->where('id',$id)
                ->get();
            return response()->json($task, 200);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

    public function store(Request $request)
    {
        if (auth()->user()) {
            $task = Task_Model::create($request->all());
            return response()->json($task, 201);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

    public function update(Request $request, Task_Model $task)
    {
        if (auth()->user()) {
            $task->update($request->all());

            return response()->json($task, 200);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

    public function destroy(Task_Model $task)
    {
        if (auth()->user()) {
            $task->delete();
            return response()->json(null, 204);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

}
