<?php

namespace App\Http\Controllers;

use App\SubTask_Model;
use App\Task_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\Input;

class MainController extends Controller
{
    public function index()
    {
        $tasks = Task_Model::with(['subtask' => function ($q) {
           $q->orderBy('priority');
        }])->get();
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

    public function create_subtask(Request $request)
    {
        $main_task_id = $request->task_id;

        $validateData = $request->validate([
            '$subtask_name' => ['required'],
            '$subtask_desc' => ['required'],
        ]);
        $subtask_name = $request->subtask_name;
        $subtask_desc = $request->subtask_desc;


        SubTask_Model::insert(['name' => $subtask_name, 'description' => $subtask_desc, 'task__model_id' => $main_task_id]);

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

    public function updateOrder(Request $request){
        if ($request->has('ids')){
            foreach ($request->ids as $index => $id){
                SubTask_Model::where('id', $id)
                    ->update(['priority' => $index,'task__model_id' => $request->task_id]);
            }


        }

            return ['success'=>true,'message'=>'Updated'];

        }

}
