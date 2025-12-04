<?php

namespace App\Http\Controllers\api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
        $completed = false;

        $create = Task::create([
            'title' => $data['title'],
            'completed' => $completed
        ]);

        if($create) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Task Created',
                    'task' => $create
                ]
            , 201); 
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Task Not Created'
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        if($task) {
            return response()->json([
                'message' => 'Task Found',
                'task' => $task
            ], 200);
        }else{
            return response()->json([
                'message' => 'Task Not Found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        if($task){
            $request->validate([
                'title' => 'required',
            ]);
            $task->title = $request->title;
            $task->save();
            return response()->json([
                'message' => 'Task Updated',
                'task' => $task
            ], 200);
        }else{
            return response()->json([
                'message' => 'Task Not Found'
            ], 404);
        }

    }


    /**
     * Toggle the specified resource in storage.
     */
    public function toggle(string $id){
        $task = Task::findOrFail($id);
        

        if($task->completed == true){
            $task->completed = false;
            $msg = 'Untick';
        }else{
            $task->completed = true;
            $msg = 'Tick';
        }

        $task->save();

        if(!$task){
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle task'
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' => "Task $msg"."ed successfully"
            ], 200);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $deleted = $task->delete();
        if($deleted){
            return response()->json([
                'success' => true, 
                'message' => 'Task Deleted Successfully'
            ], 200);
        }else{
            return response()->json([
                'success' => false, 
                'message' => 'Failed to Delete Task'
            ], 404);
        }
    }
}
