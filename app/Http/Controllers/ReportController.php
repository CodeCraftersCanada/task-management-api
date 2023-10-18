<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get the current users
        $user = auth('sanctum')->user();

        $now = date("Y-m-d G:i:s");
        $lastWeek = date("Y-m-d G:i:s", strtotime("-1 week")); // Subtract a week from the current date

        //select * from `task` where `created_at` between '2023-10-08 23:13:46.453189' and '2023-10-15 23:20:12'
        $query = DB::table('task');
        $query->whereBetween('created_at', [$lastWeek, $now]);

        $reports = [];
        $months = [];

        //admin - created_by
        if ($user->user_type_id == 1) {
            $reports['total'] = $query->where('created_by', '=', $user->id)->count();
            $reports['overall_new'] = DB::table('task')->where('task_status_id', '=', 1)->where('created_by', '=', $user->id)->count();

            $reports['total'] = $query->where('created_by', '=', $user->id)->count();
            $reports['overall_new'] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 1)->count();
            $reports['overall_inprogress'] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 2)->count();
            $reports['overall_complete'] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->count();
            $reports['new_tasks_week'] = DB::table('task')->where('created_by', '=', $user->id)->whereBetween('created_at', [$lastWeek, $now])->where('task_status_id', '=', 1)->count();
            $reports['inprogress_tasks_week'] = DB::table('task')->where('created_by', '=', $user->id)->whereBetween('created_at', [$lastWeek, $now])->where('task_status_id', '=', 2)->count();
            $reports['completed_tasks_week'] = DB::table('task')->where('created_by', '=', $user->id)->whereBetween('created_at', [$lastWeek, $now])->where('task_status_id', '=', 3)->count();

            $months[1] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-01-01 00:00:00', '2023-01-31 23:23:23'])->count();
            $months[2] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-02-01 00:00:00', '2023-02-31 23:23:23'])->count();
            $months[3] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-03-01 00:00:00', '2023-03-31 23:23:23'])->count();
            $months[4] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-04-01 00:00:00', '2023-04-31 23:23:23'])->count();
            $months[5] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-05-01 00:00:00', '2023-05-31 23:23:23'])->count();
            $months[6] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-06-01 00:00:00', '2023-06-31 23:23:23'])->count();
            $months[7] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-07-01 00:00:00', '2023-07-31 23:23:23'])->count();
            $months[8] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-08-01 00:00:00', '2023-08-31 23:23:23'])->count();
            $months[9] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-09-01 00:00:00', '2023-09-31 23:23:23'])->count();
            $months[10] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-10-01 00:00:00', '2023-10-31 23:23:23'])->count();
            $months[11] = DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-11-01 00:00:00', '2023-11-31 23:23:23'])->count();
            $months[12] =  DB::table('task')->where('created_by', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-12-01 00:00:00', '2023-12-31 23:23:23'])->count();

            $reports['completed_tasks_monthly'] = $months;
        } else {
            //member -
            $reports['total'] = $query->where('assigned_to', '=', $user->id)->count();
            $reports['overall_new'] = DB::table('task')->where('task_status_id', '=', 1)->where('assigned_to', '=', $user->id)->count();

            $reports['total'] = $query->where('assigned_to', '=', $user->id)->count();
            $reports['overall_new'] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 1)->count();
            $reports['overall_inprogress'] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 2)->count();
            $reports['overall_complete'] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->count();
            $reports['new_tasks_week'] = DB::table('task')->where('assigned_to', '=', $user->id)->whereBetween('created_at', [$lastWeek, $now])->where('task_status_id', '=', 1)->count();
            $reports['inprogress_tasks_week'] = DB::table('task')->where('assigned_to', '=', $user->id)->whereBetween('created_at', [$lastWeek, $now])->where('task_status_id', '=', 2)->count();
            $reports['completed_tasks_week'] = DB::table('task')->where('assigned_to', '=', $user->id)->whereBetween('created_at', [$lastWeek, $now])->where('task_status_id', '=', 3)->count();

            $months[1] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-01-01 00:00:00', '2023-01-31 23:23:23'])->count();
            $months[2] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-02-01 00:00:00', '2023-02-31 23:23:23'])->count();
            $months[3] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-03-01 00:00:00', '2023-03-31 23:23:23'])->count();
            $months[4] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-04-01 00:00:00', '2023-04-31 23:23:23'])->count();
            $months[5] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-05-01 00:00:00', '2023-05-31 23:23:23'])->count();
            $months[6] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-06-01 00:00:00', '2023-06-31 23:23:23'])->count();
            $months[7] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-07-01 00:00:00', '2023-07-31 23:23:23'])->count();
            $months[8] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-08-01 00:00:00', '2023-08-31 23:23:23'])->count();
            $months[9] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-09-01 00:00:00', '2023-09-31 23:23:23'])->count();
            $months[10] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-10-01 00:00:00', '2023-10-31 23:23:23'])->count();
            $months[11] = DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-11-01 00:00:00', '2023-11-31 23:23:23'])->count();
            $months[12] =  DB::table('task')->where('assigned_to', '=', $user->id)->where('task_status_id', '=', 3)->whereBetween('created_at', ['2023-12-01 00:00:00', '2023-12-31 23:23:23'])->count();

            $reports['completed_tasks_monthly'] = $months;
        }

        $results = $query->count();
        return response()->json([
            'status' => true,
            'reports' => $reports
        ]);
    }


    /**
     * Show the list of due today
     *
     * @return \Illuminate\Http\Response
     */
    public function dueToday()
    {
        $now = date("Y-m-d");
        $start = $now . ' 00:00:00';
        $end = $now . ' 23:23:23';

        $dueQuery = DB::table('task');
        $dueQuery->whereBetween('end_date', [$start,$end]);
        $tasks= $dueQuery->get();

        $results = [];
        if ($tasks) {
            foreach($tasks as $task) {
                $results[] = $task;
            }
        }

        return response()->json([
            'status' => true,
            'dueToday' => $results
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
    }
}
