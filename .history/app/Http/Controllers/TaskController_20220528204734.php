<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Task;
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
        return $this->user
            ->tasks()
            ->get();
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


        return response()->json([
            'success' => true,
            'message' => 'Zadanie zostalo dodane!',
            'data' => $task
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->only('content', 'priority', 'done');
        $validator = Validator::make($data, [
            'content' => 'required',
            'priority' => 'required',
            'done' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=> 'Niepoprawnie wprowadzone dane'], 200);
        }

        $task= $task->update([
            'content' => $request->content,
            'priority' => $request->priority,
            'done' => $request->done
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Zadanie zostalo zaktualizowane!',
            'data' => $task
        ], 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Zadanie zostalo usuniete!'
        ], 200);
    }
}
