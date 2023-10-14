<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubTask;

class SubTaskController extends Controller
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
            'subtasks' => SubTask::with('status')->get()
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
        $subTask = SubTask::create($data);

        return response()->json([
            'status' => true,
            'message' => "Sub Task created successfully!",
            'subTask' => $subTask->load('task')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubTask $subTask
     * @return \Illuminate\Http\Response
     */
    public function show(SubTask $subTask)
    {
        $subTask->load('task');

        return response()->json([
            'status' => true,
            'subtask' => $subTask
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubTask $subTask
     * @return \Illuminate\Http\Response
     */
    public function edit(SubTask $subTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\SubTask $subTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubTask $subTask)
    {
        $data = $request->all();
        $subTask->update($data);

        return response()->json([
            'status' => true,
            'message' => "Sub Tasks Updated successfully!",
            'subTask' => $subTask->load('task')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubTask $subTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTask $subTask)
    {
        $subTask->delete();

        return response()->json([
            'status' => true,
            'message' => "Sub Task deleted successfully!",
        ], 200);
    }
}
