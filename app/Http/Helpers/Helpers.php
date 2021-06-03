<?php 

use App\Models\Task;
use App\Models\Action;
use App\Models\Step;
use App\Models\OutboundMain;
use App\Models\OutboundPerson;
use Illuminate\Support\Facades\Auth;
// use DateTime;

if (!function_exists('getActions')) {
    function getActions()
    {
        $actions = Action::where('is_other', '0')
                        ->get();
        return $actions;
    }
}

if (!function_exists('getSteps')) {
    function getSteps()
    {
        $steps = Step::where('is_other', '0')
                        ->get();
        return $steps;
    }
}

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

if (!function_exists('storeOutboundMain')) {
    function storeOutboundMain($data) {
        $id = $data->id;
        
        // Create new outbound
        if ($id == 0) {
            $outboundMain = new OutboundMain();
            $outboundMain->user                 = Auth::user()->id;
            $outboundMain->account_name         = $data->account_name;
            $outboundMain->annual_report        = $data->annual_report;
            $outboundMain->pr_articles          = $data->pr_articles;
            $outboundMain->org_hooks            = $data->org_hooks;
            $outboundMain->additional_nuggets   = $data->additional_nuggets;
            $outboundMain->save();
            return $outboundMain->id;
        }

        // Update outbound
        OutboundMain::where('id', $id)
                    ->update([
                        'annual_report'         => $data->annual_report,
                        'pr_articles'           => $data->pr_articles,
                        'org_hooks'             => $data->org_hooks,
                        'additional_nuggets'    => $data->additional_nuggets
                    ]);
        return $id;
    }
}

if (!function_exists('storeOutboundPerson')) {
    function storeOutboundPerson($data) {
        $id = $data->id;
        
        // Create new outbound person
        if ($id == 0) {
            $outboundPerson = new OutboundPerson();
            $outboundPerson->o_id           = $data->o_id;
            $outboundPerson->first_name     = $data->first_name;
            $outboundPerson->last_name      = $data->last_name;
            $outboundPerson->title          = $data->title;
            $outboundPerson->phone          = $data->phone;
            $outboundPerson->mobile         = $data->mobile;
            $outboundPerson->email          = $data->email;
            $outboundPerson->calls          = $data->calls;
            $outboundPerson->result         = $data->result;
            $outboundPerson->li_connected   = $data->li_connected;
            $outboundPerson->notes          = $data->notes;
            $outboundPerson->li_address     = $data->li_address;
            $outboundPerson->save();
            return $outboundPerson->id;
        }

        // Update outbound person
        OutboundPerson::where('id', $id)
                    ->update([
                        'o_id' => $data->o_id,
                        'first_name' => $data->first_name,
                        'last_name' => $data->last_name,
                        'title' => $data->title,
                        'phone' => $data->phone,
                        'mobile' => $data->mobile,
                        'email' => $data->email,
                        'calls' => $data->calls,
                        'result' => $data->result,
                        'li_connected' => $data->li_connected,
                        'notes' => $data->notes,
                        'li_address' => $data->li_address
                    ]);
        return $id;
    }
}

if (!function_exists('deleteOutboundMain')) {
    function deleteOutboundMain($id) {
        $result1 = OutboundMain::where('id', $id)
                            ->delete();
        $result2 = OutboundPerson::where('o_id', $id)
                            ->delete();
        return $result1 && $result2;
    }
}

if (!function_exists('deleteOutboundPerson')) {
    function deleteOutboundPerson($id) {
        $result = OutboundPerson::where('id', $id)
                            ->delete();
        return $result;
    }
}

if (!function_exists('getOutboundPersonsAsArray')) {
    function getOutboundPersonsAsArray($oId)
    {
        $persons = OutboundPerson::where('o_id', $oId)
                                ->get()
                                ->all();
        return $persons;
    }
}