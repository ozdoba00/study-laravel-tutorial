<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{

    public function index()
    {
        $userId = Auth::user()->id;

        $tasks = Task::where('user_id', $userId)->get();

        return $tasks;
    }
}
