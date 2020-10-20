<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask_Model extends Model
{
    protected $table = 'subtask';

    public function Task(){
        return $this->belongsTo('App\Task_Model');
    }
}
