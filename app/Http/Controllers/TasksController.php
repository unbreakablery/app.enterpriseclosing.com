<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskSetting;
use App\Models\TaskSuggestSetting;
use App\Models\OpportunityMain;
use App\Models\User;
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

    public function getTasks(Request $request)
    {   
        if (Auth::user()->role == '2') {
            User::where('id', Auth::user()->id)
                ->update(['role' => '1']);
            return redirect()->route('settings');
        }

        $actions = getActions();
        $steps = getSteps();
        $settings = TaskSetting::where('user_id', Auth::user()->id)
                            ->get();

        $tasks = Task::where([
                                ['tasks.status', '=', '0'],
                                ['tasks.user', '=', Auth::user()->id]
                            ])
                        ->join('actions', 'actions.id', '=', 'tasks.action')
                        ->join('steps', 'steps.id', '=', 'tasks.step')
                        ->leftJoin('opportunities_main', 'opportunities_main.id', '=', 'tasks.opportunity')
                        ->select('tasks.*', 'actions.name AS action_name', 'steps.name AS step_name', 'opportunities_main.opportunity AS opportunity_name')
                        ->orderBy('by_date', 'ASC')
                        ->get()
                        ->all();
        
        $nl_tasks_class = 'active';
        $user_action = (isset($request->user_action)) ? $request->user_action : '';
        $saved_step = old('saved_step');
        $suggest_person_account = (isset($request->person_account)) ? $request->person_account : '';
        $suggest_opportunity = (isset($request->opportunity)) ? $request->opportunity : '';
        
        //get suggested steps for additional tasks
        $suggest_steps = TaskSuggestSetting::where('user_id', Auth::user()->id)
                                ->where('step_id', (!empty($saved_step)) ? $saved_step : 0)
                                ->join('steps', 'tasks_suggest_settings.suggest_step_id', '=', 'steps.id')
                                ->select('steps.id', 'steps.name')
                                ->distinct('steps.id')
                                ->orderBy('steps.name')
                                ->get();
        $suggest_actions = TaskSetting::where('user_id', Auth::user()->id)
                                ->where('section_type', 1)
                                ->join('actions', 'tasks_settings.section_id', '=', 'actions.id')
                                ->select('actions.id', 'actions.name')
                                ->distinct('actions.id')
                                ->orderBy('actions.name')
                                ->get();
        $opportunities = OpportunityMain::where('user', Auth::user()->id)
                                ->select('id', 'opportunity')
                                ->orderBy('id')
                                ->get();
        
        return view('pages.tasks', 
                    compact(
                        'actions',
                        'steps',
                        'settings',
                        'tasks',
                        'nl_tasks_class',
                        'user_action',
                        'suggest_steps',
                        'suggest_actions',
                        'suggest_person_account',
                        'suggest_opportunity',
                        'opportunities'
                    )
        );
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

        // Get opportunities
        $opportunities = OpportunityMain::where('user', Auth::user()->id)
                        ->select('id', 'opportunity')
                        ->orderBy('id')
                        ->get();

        return redirect()->route('tasks')->withInput([
            'user_action' => 'add-task',
            'saved_action' => $task->action,
            'saved_step' => $task->step,
            'saved_person_account' => $task->person_account,
            'saved_opportunity' => $task->opportunity,
            'saved_by_date' => $request->input('by-date'),
            'opportunities' => $opportunities
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
