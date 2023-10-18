<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Task;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = auth('sanctum')->user();
        $invoices = [];
        //admin
        if ($user->user_type_id == 1) {
            $invoices = Invoice::with('creator','payee', 'task')->where('created_by', '=', $user->id)->get();
        } else {
            //member
            $invoices = Invoice::with('creator','payee', 'task')->where('paid_to', '=', $user->id)->get();
        }

        return response()->json([
            'status' => true,
            'invoices' => $invoices
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
        $invoice = Invoice::create($request->all());

        $this->recomputeOverTaskHours($invoice->task_id);

        return response()->json([
            'status' => true,
            'message' => "Invoice created successfully!",
            'invoice' => $invoice->load('creator','payee', 'task')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('creator','payee', 'task');

        return response()->json([
            'status' => true,
            'invoice' => $invoice
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->all();
        $invoice->update($data);

        return response()->json([
            'status' => true,
            'message' => "Invoices Updated successfully!",
            'invoice' => $invoice->load('creator','payee', 'task')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();


        return response()->json([
            'status' => true,
            'message' => "Invoice deleted successfully!",
        ], 200);
    }

    private function recomputeOverTaskHours($taskID)
    {
        $tasks = Task::find($taskID);

        $hours = 0;
        $paidHours = 0;
        if ($tasks) {
            if($tasks->subTasks){
                foreach($tasks->subTasks as $subTask){
                    $hours += $subTask->task_hours;
                }
            }

            if($tasks->invoices){
                foreach($tasks->invoices as $invoice){
                    $paidHours += $invoice->total_hours;
                }
            }
        }

        $tasks->update([
                'task_hours' => $hours,
                'paid_task_hours' => $paidHours,
                'unpaid_task_hours' => $hours - $paidHours,
                ]
            );

    }
}
