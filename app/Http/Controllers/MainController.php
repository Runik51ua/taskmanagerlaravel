<?php

namespace App\Http\Controllers;

use App\SubTask_Model;
use App\Task_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index()
    {
        $tasks = Task_Model::orderBy('id')->paginate(5);
        $subtasks = SubTask_Model::orderBy('priority')->get();
        return view('layout', compact('tasks', 'subtasks'));
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

    public function create_subtask(Request $request)
    {
        $main_task_id = $request->task_id;
        $subtask_name = $request->subtask_name;
        $subtask_desc = $request->subtask_desc;
        $subtask_priority = $request->subtask_priority;

        SubTask_Model::insert(['name' => $subtask_name, 'description' => $subtask_desc, 'main_task_id' => $main_task_id, 'priority' => $subtask_priority]);

        return redirect()->route('home');


    }

    public function delete_subtask(Request $request){
        SubTask_Model::where('id', '=' , $request->subtask_id)->delete();
        return redirect()->route('home');
    }

    public function delete(Request $request)
    {
        Task_Model::where('id', '=' , $request->task_id)->delete();
        return redirect()->route('home');
    }
}
