<?php

namespace App\Http\Controllers;

use App\SubTask_Model;
use Illuminate\Http\Request;

class Api_SubTask_Controller extends Controller
{
    public function store(Request $request)
    {
        $subTask =  SubTask_Model::create($request->all());

        return response()->json($subTask, 201);
    }

    public function update(Request $request, SubTask_Model $subTask)
    {
        $subTask->update($request->all());

        return response()->json($subTask, 200);
    }

    public function delete(SubTask_Model $subTask)
    {
        $subTask->delete();

        return response()->json(null, 204);
    }



}
