<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
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
        if ($request->ajax()) {
            $action             = $request->suggest_action;
            $step               = $request->suggest_step;
            $person_account     = $request->suggest_person_account;
            $opportunity        = $request->suggest_opportunity;
            $note               = $request->suggest_note;
            $by_date            = $request->suggest_date;
            $priority           = $request->suggest_priority;

            $task = storeTask($action, $step, $person_account, $opportunity, $note, $by_date, $priority);
            $task = getTask($task->id);
            return response()->json([
                'task_id' => $task->id,
                'action_name' => $task->action_name,
                'step_name' => $task->step_name,
                'status' => 'success'
            ]);
        }

        $action             = $request->input('action');
        $step               = $request->input('step');
        $person_account     = $request->input('person-account');
        $opportunity        = $request->input('opportunity');
        $note               = $request->input('note');
        $by_date            = $request->input('by-date');
        $priority           = $request->input('priority');
        
        // add it action/step table if other action and step
        if ($action == 0) {
            $action = storeAction($request->input('action-other-name'));
        }
        if ($step == 0) {
            $step = storeStep($request->input('step-other-name'));
        }

        // save task
        $task = storeTask($action, $step, $person_account, $opportunity, $note, $by_date, $priority);

        return redirect()->route('tasks')->withInput([
            'user_action' => 'add-task',
            'saved_action' => $task->action,
            'saved_step' => $task->step,
            'saved_person_account' => $task->person_account,
            'saved_opportunity' => $task->opportunity,
            'saved_by_date' => $request->input('by-date')
        ]);
    }

    public function saveTask(Request $request)
    {
        $id             = $request->input('id');
        $status         = $request->input('status');
        $completed_at   = NULL;

        if ($status == '2') {
            $completed_at = DateTime::createFromFormat('d-m-Y', date('d-m-Y'));
        }
        
        Task::where([
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
