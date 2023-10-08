<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'taskStatus' => TaskStatus::orderBy('name')->get()
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
        $taskStatus = TaskStatus::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Task status created successfully!",
            'taskStatus' => $taskStatus
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TaskStatus $taskStatus)
    {
        return response()->json([
            'status' => true,
            'taskStatus' => $taskStatus
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $taskStatus->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Tasks status Updated successfully!",
            'task' => $taskStatus
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();

        return response()->json([
            'status' => true,
            'message' => "Task status deleted successfully!",
        ], 200);
    }
}
