<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{

    protected $user;
    public function index()
    {
        return $this->user
            ->products()
            ->get();

    }
}
