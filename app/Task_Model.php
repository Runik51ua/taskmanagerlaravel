<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Model extends Model
{
     protected $table = 'tasks';

    public function subtask(){
        return $this->hasMany('App\SubTask_Model');
    }
}
