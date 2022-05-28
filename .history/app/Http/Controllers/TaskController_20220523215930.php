<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Task;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class TaskController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function index()
    {
        // return zadanka
    }

    public function store(Request $request)
    {
        $data = $request->only('content', 'priority');
        $validator = Validator::make($data, [
            'content' => 'required',
            'priority' => 'required'
        ]);
        if($validator->fails()){

        }
    }
}
