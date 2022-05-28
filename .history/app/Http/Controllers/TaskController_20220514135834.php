<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index(Task $task)
    {
        $tasks = $task->all();
        return $tasks;
    }
}
