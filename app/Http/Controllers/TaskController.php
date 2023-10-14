<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $task = [];
        if (isset($data['task_status_id']) && $data['task_status_id']) {
            $task = Task::with('status', 'creator', 'assigned', 'subTasks')->where('task_status_id', '=', $data['task_status_id'])->get();

        } else {
            $task = Task::with('status', 'creator', 'assigned', 'subTasks')->get();
        }

        return response()->json([
            'status' => true,
            'tasks' => $task
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['start_date'] = $data['start_date']? date("Y-m-d", strtotime($data['start_date'])) : date("Y-m-d");
        $data['end_date'] = $data['end_date']? date("Y-m-d", strtotime($data['end_date'])) : date("Y-m-d");

        $task = Task::create($data);

        return response()->json([
            'status' => true,
            'message' => "Task created successfully!",
            'task' => $task->load('status', 'creator', 'assigned')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task->load('status', 'creator', 'assigned');

        return response()->json([
            'status' => true,
            'task' => $task
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->all();
        $data['start_date'] = $data['start_date']? date("Y-m-d", strtotime($data['start_date'])) : date("Y-m-d");
        $data['end_date'] = $data['end_date']? date("Y-m-d", strtotime($data['end_date'])) : date("Y-m-d");


        $task->update($data);

        return response()->json([
            'status' => true,
            'message' => "Tasks Updated successfully!",
            'task' => $task->load('status', 'creator', 'assigned')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'status' => true,
            'message' => "Task deleted successfully!",
        ], 200);
    }
}