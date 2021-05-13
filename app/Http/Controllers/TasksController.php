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
        $action = $request->input('action');
        $step = $request->input('step');
        $from_to_account = $request->input('from-to-account');
        $opportunity = $request->input('opportunity');
        $by_date = $request->input('by-date');
        $priority = $request->input('priority');

        $task_id = Tasks::insertGetId([
            'user'              => Auth::user()->id,
            'action'            => $action,
            'step'              => $step,
            'from_to_account'   => $from_to_account,
            'opportunity'       => $opportunity,
            'by_date'           => DateTime::createFromFormat('d-m-Y', $by_date),
            'priority'          => $priority
        ]);
        $request->session()->flash('success', 'Task was added successfully ! (Task #: ' . $task_id . ')');
        return redirect()->route('tasks');
    }
}
