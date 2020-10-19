<?php

namespace App\Http\Controllers;

use App\Task_Model;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $tasks = Task_Model::orderBy('id')->paginate(5);
        return view('layout', compact('tasks'));
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
           'task_name' => ['required'],
           'task_desc' => ['required'],
        ]);
        $Task_name = $request->task_name;
        $Task_desc = $request->task_desc;

        Task_Model::insert(['name' => $Task_name, 'description' => $Task_desc]);


        return redirect()->route('home');
    }

    public function delete(Request $request)
    {
        Task_Model::where('id', '=' , $request->task_id)->delete();
        return redirect()->route('home');
    }
}
