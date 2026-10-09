<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function today()
    {
        $model = new TaskModel();

        $tasks = $model
            ->where('task_date', date('Y-m-d'))
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('tasks/today', [
            'tasks' => $tasks,
        ]);
    }

    public function index()
    {
        $model = new TaskModel();

        $tasks = $model
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('tasks/index', [
            'tasks' => $tasks,
        ]);
    }
}