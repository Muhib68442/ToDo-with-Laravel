<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::with('user')
             ->where('user_id', auth()->id())
             ->orderBy('completed')
             ->orderBy('updated_at', 'desc')
             ->get();        
        return view('index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = $request->validate([
            'title' => 'required',
            
        ]);
        
        $task['completed'] = false;
        $task['user_id'] = auth()->user()->id;
        // return $task['user_id'];

        Task::create($task);
        return redirect()->route('web.task.index')->with('message', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
                
        // PREVENT OTHER FROM ACCESS
        if($task->user_id != auth()->user()->id){
            return redirect()->route('web.task.index')->with('message', 'Access Denied');
        }

        if($task){
            return view('show', compact('task'));
        }else{
            return redirect()->route('web.task.index')->with('message', 'Task not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Task::findOrFail($id);
                
        // PREVENT OTHER FROM ACCESS
        if($data->user_id != auth()->user()->id){
            return redirect()->route('web.task.index')->with('message', 'Access Denied');
        }
        return view('edit', ['old_task_data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        
        $data = Task::findOrFail($id);

        $data->title = $request->title;
        $data->completed = false;
        $data->save();
        return redirect()->route('web.task.index')->with('message', 'Task Updated Successfully');
    }

    public function toggle(string $id){
        $task = Task::findOrFail($id);

        // PREVENT OTHER FROM ACCESS
        if($task->user_id != auth()->user()->id){
            return redirect()->route('web.task.index')->with('message', 'Access Denied');
        }

        if ($task->completed) {
            $task->completed = false;
            $msg = 'Untick';
        } else {
            $task->completed = true;
            $msg = 'Tick';
        }
        $task->save();
        return redirect()->back()->with('message', 'Task '.$msg.'ed Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        // PREVENT OTHER FROM ACCESS
        if($task->user_id != auth()->user()->id){
            return redirect()->route('web.task.index')->with('message', 'Access Denied');
        }

        $task->delete();
        return redirect()->route('web.task.index')->with('message', 'Task Deleted Successfully');
    }
}
