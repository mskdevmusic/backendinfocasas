<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskModel extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'id';
    public $incrementing = true;

    public $timestamps = true;

    public function getTask($id)
    {
        $resultQuery = DB::select("CALL sp_getTask('" . $id . "');");

        return $resultQuery;
    }

    public function getAllTask()
    {
        $resultQuery = DB::select("CALL sp_getAllTask();");

        return $resultQuery;
    }

    public function deleteTask($id)
    {
        $resultQuery = DB::select("CALL sp_deleteTask('" . $id . "', @mensaje);");
        $resultQuery = DB::select("SELECT @mensaje MENSAJE;");

        return $resultQuery;
    }

    public function updateTask($task)
    {
        $resultQuery = DB::select("CALL sp_updateTask('" . $task->id . "', '" . $task->name . "', '" . $task->desc . "', " . $task->completed . ", @mensaje);");
        $resultQuery = DB::select("SELECT @mensaje MENSAJE;");
        return $resultQuery;
    }

    public function insertTask($task)
    {
        $resultQuery = DB::select("CALL sp_insertTask('" . $task->name . "', '" . $task->desc . "', @mensaje);");
        $resultQuery = DB::select("SELECT @mensaje MENSAJE;");

        return $resultQuery;
    }
}
