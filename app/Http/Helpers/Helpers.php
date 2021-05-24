<?php 

use App\Models\Task;
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