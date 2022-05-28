<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        $userId = Auth::user()->id;

        $tasks = Task::where('user_id', $userId)->get();

        return $tasks;
    }
}
