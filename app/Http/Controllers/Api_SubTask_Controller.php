<?php

namespace App\Http\Controllers;

use App\SubTask_Model;
use Illuminate\Http\Request;

class Api_SubTask_Controller extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()) {
            $subTask =  SubTask_Model::create($request->all());

            return response()->json($subTask, 201);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()) {
            $subTask = SubTask_Model::where('id',$id)->update($request->all());
            return response()->json($subTask, 200);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }

    public function destroy(SubTask_Model $subTask)
    {
        if (auth()->user()) {
            $subTask->delete();

            return response()->json(null, 204);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }



}
