<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Task_Model;
use Illuminate\Http\Request;

class Api_Tasks_Controller extends Controller
{
    public function index()
    {
        return Task_Model::with(['subtask' => function ($q) {
            $q->orderBy('priority');
        }])->get();;
    }

    public function show($id)
    {
        $task = Task_Model::with(['subtask' => function ($q) {
            $q->orderBy('priority');
        }])->where('id',$id)
            ->get();
        return response()->json($task, 200);
    }

    public function store(Request $request)
    {
        $task = Task_Model::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, Task_Model $task)
    {
        $task->update($request->all());

        return response()->json($task, 200);
    }

    public function destroy(Task_Model $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }

}
