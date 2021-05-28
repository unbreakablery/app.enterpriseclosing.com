<?php 

use App\Models\Task;
use App\Models\Action;
use App\Models\Step;
use Illuminate\Support\Facades\Auth;
// use DateTime;

if (!function_exists('storeTask')) {
    function storeTask($action, $step, $person_account, $opportunity, $note, $by_date, $priority) {
        $task = new Task();
        $task->user             = Auth::user()->id;
        $task->action           = $action;
        $task->step             = $step;
        $task->person_account   = $person_account;
        $task->opportunity      = $opportunity;
        $task->note             = $note;
        $task->by_date          = \DateTime::createFromFormat('d-m-Y', $by_date);
        $task->priority         = $priority;
        $task->save();

        return $task;
    }
}

if (!function_exists('getTask')) {
    function getTask($id) {
        $task = Task::where([
                                ['tasks.id', '=', $id],
                                ['tasks.user', '=', Auth::user()->id]
                            ])
                        ->join('actions', 'actions.id', '=', 'tasks.action')
                        ->join('steps', 'steps.id', '=', 'tasks.step')
                        ->select('tasks.*', 'actions.name AS action_name', 'steps.name AS step_name')
                        ->get()
                        ->first();
        return $task;
    }
}

if (!function_exists('storeAction')) {
    function storeAction($action_name) {
        $action_name = trim($action_name);
        $action = Action::where('name', $action_name)
                    ->get()
                    ->first();
        if ($action != null) {
            return $action->id;
        }

        $action = new Action();
        $action->name = $action_name;
        $action->is_other = '1';
        $action->save();
        return $action->id;
    }
}

if (!function_exists('storeStep')) {
    function storeStep($step_name) {
        $step_name = trim($step_name);
        $step = Step::where('name', $step_name)
                    ->get()
                    ->first();
        if ($step != null) {
            return $step->id;
        }

        $step = new Step();
        $step->name = $step_name;
        $step->is_other = '1';
        $step->save();
        return $step->id;
    }
}