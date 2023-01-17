<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTask($id = null)
    {
        $taskmodel = new TaskModel();

        $task = $taskmodel->getTask($id);

        $jsonresponse = array(
            "status" => 200,
            "data" => $task
        );

        return response(json_encode($jsonresponse, true), 200)->header('Content-Type', 'application/json');
    }

    public function getAllTask()
    {
        $taskmodel = new TaskModel();

        $tasks = $taskmodel->getAllTask();

        $jsonresponse = array(
            "status" => 200,
            "data" => $tasks
        );

        return response(json_encode($jsonresponse, true), 200)->header('Content-Type', 'application/json');
    }

    public function deleteTask($id = null)
    {
        $taskmodel = new TaskModel();

        $responseModel = $taskmodel->deleteTask($id);

        if($responseModel[0]->MENSAJE === 'ELIMINADO EXITOSAMENTE'){
            $jsonresponse = array(
                "status" => 200,
                "data" => $responseModel[0]
            );
        }else{
            $jsonresponse = array(
                "status" => 500,
                "data" => $responseModel[0]
            );
        }

        return response(json_encode($jsonresponse, true), $jsonresponse['status'])->header('Content-Type', 'application/json');
    }

    public function updateTask(Request $request)
    {
        $taskmodel = new TaskModel();

        $responseModel = $taskmodel->updateTask($request);

        if ($responseModel[0]->MENSAJE === 'ACTUALIZADO EXITOSAMENTE') {
            $jsonresponse = array(
                "status" => 200,
                "data" => $responseModel[0]
            );
        } else {
            $jsonresponse = array(
                "status" => 500,
                "data" => $responseModel[0]
            );
        }

        return response(json_encode($jsonresponse, true), $jsonresponse['status'])->header('Content-Type', 'application/json');
    }

    public function insertTask(Request $request)
    {
        $taskmodel = new TaskModel();

        $responseModel = $taskmodel->insertTask($request);

        if ($responseModel[0]->MENSAJE === 'REGISTRADO EXITOSAMENTE') {
            $jsonresponse = array(
                "status" => 200,
                "data" => $responseModel[0]
            );
        } else {
            $jsonresponse = array(
                "status" => 500,
                "data" => $responseModel[0]
            );
        }

        return response(json_encode($jsonresponse, true), $jsonresponse['status'])->header('Content-Type', 'application/json');
    }
}
