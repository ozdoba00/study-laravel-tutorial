<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Task;
use Error;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
            return response()->json(['error'=> 'Niepoprawnie wprowadzone dane'], 200);
        }

        $task = $this->user->tasks()->create([
            'content' => $request->content,
            'priority' => $request->priority,
            'done' => '0'
        ]);

        try {
            return response()->json([
                'success' => true,
                'message' => 'Zadanie zostalo dodane!',
                'data' => $task
            ], 200);
        } catch (Error $e) {

            throw($e);
        }


    }
}
