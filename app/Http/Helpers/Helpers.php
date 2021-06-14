<?php 

use App\Models\Task;
use App\Models\Action;
use App\Models\Step;
use App\Models\OutboundMain;
use App\Models\OutboundPerson;
use App\Models\OpportunityMain;
use App\Models\OpportunityMeddpicc;
use App\Models\ScriptMain;
use App\Models\User;
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

if (!function_exists('storeUser')) {
    function storeUser($data) {
        $userId = $data->user_id;
        $firstName = $data->first_name;
        $lastName = $data->last_name;
        $password = $data->password;
        $email = $data->email;
        $phone = $data->phone;
        $organisation = $data->organisation;
        $region = $data->region;
        $industry = $data->industry;

        if (!empty($password)) {
            $password = Hash::make($password);

            User::where('id', $userId)
                ->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'password' => $password,
                    'email' => $email,
                    'phone' => $phone,
                    'organisation' => $organisation,
                    'region' => $region,
                    'industry' => $industry
                ]);
        } else {
            User::where('id', $userId)
                ->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'organisation' => $organisation,
                    'region' => $region,
                    'industry' => $industry
                ]);
        }
        
        return $userId;
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

if (!function_exists('storeOpportunityMain')) {
    function storeOpportunityMain($data) {
        $id = $data->get('opp-id');
        
        // Create new opportunity
        if ($id == 0) {
            $opportunityMain = new OpportunityMain();
            $opportunityMain->user              = Auth::user()->id;
            $opportunityMain->opportunity       = $data->get('opportunity-name');
            $opportunityMain->usecase           = $data->usecase;
            $opportunityMain->emp_num           = $data->emp_num;
            $opportunityMain->close_date        = (empty($data->close_date)) ? null : \DateTime::createFromFormat('d-m-Y', $data->close_date);
            $opportunityMain->stage             = $data->stage;
            $opportunityMain->next_step         = $data->next_step;
            $opportunityMain->amount            = $data->amount;
            $opportunityMain->currency          = $data->currency;
            $opportunityMain->lead_source       = $data->lead_source;
            $opportunityMain->compelling_event  = $data->compelling_event;
            $opportunityMain->competition       = $data->competition;
            $opportunityMain->sponsor           = $data->sponsor;
            $opportunityMain->what_new_changed  = $data->what_new_changed;
            $opportunityMain->red_flags         = $data->red_flags;
            $opportunityMain->folder_link       = $data->folder_link;
            
            $opportunityMain->save();
            return $opportunityMain->id;
        }

        // Update opportunity
        OpportunityMain::where('id', $id)
                    ->update([
                        'usecase'           => $data->usecase,
                        'emp_num'           => $data->emp_num,
                        'close_date'        => (empty($data->close_date)) ? null : \DateTime::createFromFormat('d-m-Y', $data->close_date),
                        'stage'             => $data->stage,
                        'next_step'         => $data->next_step,
                        'amount'            => $data->amount,
                        'currency'          => $data->currency,
                        'lead_source'       => $data->lead_source,
                        'compelling_event'  => $data->compelling_event,
                        'competition'       => $data->competition,
                        'sponsor'           => $data->sponsor,
                        'what_new_changed'  => $data->what_new_changed,
                        'red_flags'         => $data->red_flags,
                        'folder_link'       => $data->folder_link
                    ]);
        return $id;
    }
}

if (!function_exists('storeOpportunityMeddpicc')) {
    function storeOpportunityMeddpicc($data) {
        $oppId = $data->get('opp-id');
        $meddpicc = OpportunityMeddpicc::where('opp_id', $oppId)
                                    ->get()
                                    ->first();

        // Create new opportunity meddpicc
        if (empty($meddpicc)) {
            $opportunityMeddpicc = new OpportunityMeddpicc();
            $opportunityMeddpicc->opp_id                    = $oppId;
            $opportunityMeddpicc->metrics                   = $data->metrics;
            $opportunityMeddpicc->metrics_score             = $data->metrics_score;
            $opportunityMeddpicc->economic_buyer            = $data->economic_buyer;
            $opportunityMeddpicc->economic_buyer_score      = $data->economic_buyer_score;
            $opportunityMeddpicc->decision_criteria         = $data->decision_criteria;
            $opportunityMeddpicc->decision_criteria_score   = $data->decision_criteria_score;
            $opportunityMeddpicc->decision_process          = $data->decision_process;
            $opportunityMeddpicc->decision_process_score    = $data->decision_process_score;
            $opportunityMeddpicc->paper_process             = $data->paper_process;
            $opportunityMeddpicc->paper_process_score       = $data->paper_process_score;
            $opportunityMeddpicc->identified_pain           = $data->identified_pain;
            $opportunityMeddpicc->identified_pain_score     = $data->identified_pain_score;
            $opportunityMeddpicc->champion_coach            = $data->champion_coach;
            $opportunityMeddpicc->champion_coach_score      = $data->champion_coach_score;
            $opportunityMeddpicc->competition               = $data->competition;
            $opportunityMeddpicc->competition_score         = $data->competition_score;
            $opportunityMeddpicc->meddpicc_score            = $data->meddpicc_score;
            
            $opportunityMeddpicc->save();

            // $opportunityMeddpicc->create($data->all());
            return $opportunityMeddpicc->id;
        }

        // Update opportunity meddpicc
        OpportunityMeddpicc::where('opp_id', $oppId)
                    ->update([
                        'metrics'                   => $data->metrics,
                        'metrics_score'             => $data->metrics_score,
                        'economic_buyer'            => $data->economic_buyer,
                        'economic_buyer_score'      => $data->economic_buyer_score,
                        'decision_criteria'         => $data->decision_criteria,
                        'decision_criteria_score'   => $data->decision_criteria_score,
                        'decision_process'          => $data->decision_process,
                        'decision_process_score'    => $data->decision_process_score,
                        'paper_process'             => $data->paper_process,
                        'paper_process_score'       => $data->paper_process_score,
                        'identified_pain'           => $data->identified_pain,
                        'identified_pain_score'     => $data->identified_pain_score,
                        'champion_coach'            => $data->champion_coach,
                        'champion_coach_score'      => $data->champion_coach_score,
                        'competition'               => $data->competition,
                        'competition_score'         => $data->competition_score,
                        'meddpicc_score'            => $data->meddpicc_score
                    ]);
        // $meddpicc->update($data->all());
        return $meddpicc->id;
    }
}

if (!function_exists('storeScriptMain')) {
    function storeScriptMain($data) {
        $id = $data->get('id');
        
        // Create new script main
        if ($id == 0 || $id == null) {
            $scriptMain             = new ScriptMain();
            $scriptMain->user       = Auth::user()->id;
            $scriptMain->name       = $data->name;
            $scriptMain->content    = $data->content;
            
            $scriptMain->save();
            return $scriptMain;
        }

        // Update script main
        $scriptMain = ScriptMain::where('id', $id)->get()->first();
        $scriptMain->name = $data->name;
        $scriptMain->content = $data->content;
        $scriptMain->update();
        
        return $scriptMain;
    }
}

if (!function_exists('deleteScriptMain')) {
    function deleteScriptMain($id) {
        if (empty($id)) {
            return false;
        }
        
        $result = ScriptMain::where('id', $id)->delete();

        return $result;
    }
}