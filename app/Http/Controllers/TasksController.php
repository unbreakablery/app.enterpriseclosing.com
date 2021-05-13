<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use Auth;
use DateTime;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTask(Request $request)
    {
        $action             = $request->input('action');
        $step               = $request->input('step');
        $from_to_account    = $request->input('from-to-account');
        $opportunity        = $request->input('opportunity');
        $by_date            = $request->input('by-date');
        $priority           = $request->input('priority');

        $task = new Tasks();
        $task->user             = Auth::user()->id;
        $task->action           = $action;
        $task->step             = $step;
        $task->from_to_account  = $from_to_account;
        $task->opportunity      = $opportunity;
        $task->by_date          = DateTime::createFromFormat('d-m-Y', $by_date);
        $task->priority         = $priority;
        $task->save();
        
        // $request->session()->flash('success', 'Task was added successfully ! (Task #: ' . $task->id . ')');
        return redirect()->route('tasks');
    }

    public function saveTask(Request $request)
    {
        $id             = $request->input('id');
        $status         = $request->input('status');
        $completed_at   = NULL;

        if ($status == '2') {
            $completed_at = DateTime::createFromFormat('d-m-Y', date('d-m-Y'));
        }
        
        Tasks::where([
                        'id' => $id
                    ])
                ->update([
                        'status'        => $status,
                        'completed_at'  => $completed_at
                    ]);
                            
        return response()->json([
                                    'type'      => 'success',
                                    'message'   => 'Task #'. $id . ' was updated successfully !'
                                ]);
    }
}
