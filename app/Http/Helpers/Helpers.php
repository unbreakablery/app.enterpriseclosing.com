<?php 

use App\Models\Task;
use App\Models\TaskSetting;
use App\Models\TaskSuggestSetting;
use App\Models\Action;
use App\Models\Step;
use App\Models\OutboundMain;
use App\Models\OutboundPerson;
use App\Models\OpportunityMain;
use App\Models\OpportunityMeddpicc;
use App\Models\OpportunitySetting;
use App\Models\OpportunitySalesStage;
use App\Models\ScriptMain;
use App\Models\EmailMain;
use App\Models\SkillMain;
use App\Models\SkillAssessment;
use App\Models\SkillSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

if (!function_exists('formatWithZero')) {
    function formatWithZero($number) {
        return ($number < 10) ? '0' . $number : $number;
    }
}

if (!function_exists('getAction')) {
    function getAction($actionName, $is_other = '0')
    {
        $action = Action::where('name', $actionName)
                        ->where('is_other', $is_other)
                        ->get()
                        ->first();
        
        return $action;
    }
}

if (!function_exists('getStep')) {
    function getStep($stepName, $is_other = '0')
    {
        $step = Step::where('name', $stepName)
                        ->where('is_other', $is_other)
                        ->get()
                        ->first();

        return $step;
    }
}

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

if (!function_exists('getStepById')) {
    function getStepById($id)
    {
        $step = Step::where('is_other', '0')
                    ->where('id', $id)
                    ->get();
        return $step;
    }
}

if (!function_exists('getActionsForCurrentUser')) {
    function getActionsForCurrentUser()
    {
        $actions = TaskSetting::where('user_id', Auth::user()->id)
                                ->where('section_type', 1)
                                ->join('actions', 'tasks_settings.section_id', '=', 'actions.id')
                                ->select('actions.id', 'actions.name')
                                ->distinct('actions.id')
                                ->orderBy('actions.name')
                                ->get();
        return $actions;
    }
}

if (!function_exists('getStepsForCurrentUser')) {
    function getStepsForCurrentUser()
    {
        $steps = TaskSetting::where('user_id', Auth::user()->id)
                                ->where('section_type', 2)
                                ->join('steps', 'tasks_settings.section_id', '=', 'steps.id')
                                ->select('steps.id', 'steps.name')
                                ->distinct('steps.id')
                                ->orderBy('steps.name')
                                ->get();
        return $steps;
    }
}

if (!function_exists('getSuggestSteps')) {
    function getSuggestSteps($step)
    {
        $suggest_steps = TaskSuggestSetting::where('user_id', Auth::user()->id)
                                ->where('step_id', (!empty($step)) ? $step : 0)
                                ->join('steps', 'tasks_suggest_settings.suggest_step_id', '=', 'steps.id')
                                ->select('steps.id', 'steps.name')
                                ->distinct('steps.id')
                                ->orderBy('steps.name')
                                ->get();
        return $suggest_steps;
    }
}

if (!function_exists('getOpportunities')) {
    function getOpportunities()
    {
        $opportunities = OpportunityMain::where('user', Auth::user()->id)
                        ->select('id', 'opportunity')
                        ->get();
        return $opportunities;
    }
}

if (!function_exists('storeTask')) {
    function storeTask($action, $step, $person_account, 
                    $opportunity, $note, $by_date, $priority)
    {
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
    function getTask($id)
    {
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
    function storeUser($data)
    {
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
    function storeAction($action_name)
    {
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
    function storeStep($step_name)
    {
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
    function storeOutboundMain($data)
    {
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
    function storeOutboundPerson($data)
    {
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
    function deleteOutboundMain($id)
    {
        $result1 = OutboundMain::where('id', $id)
                            ->delete();
        $result2 = OutboundPerson::where('o_id', $id)
                            ->delete();
        return $result1 && $result2;
    }
}

if (!function_exists('deleteOutboundPerson')) {
    function deleteOutboundPerson($id)
    {
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
    function storeOpportunityMain($data)
    {
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
            $opportunityMain->user_num          = $data->user_num;
            $opportunityMain->sponsor           = $data->sponsor;
            $opportunityMain->what_new_changed  = $data->what_new_changed;
            $opportunityMain->red_flags         = $data->red_flags;
            $opportunityMain->folder_link       = $data->folder_link;
            
            $opportunityMain->save();
            return $opportunityMain->id;
        }

        // Update opportunity main
        $opportunity = OpportunityMain::where('id', $id)->get()->first();
        if (!empty($data->opportunity)) {
            $opportunity->opportunity = $data->opportunity;
        }
        if (!empty($data->usecase)) {
            $opportunity->usecase = $data->usecase;
        }
        if (!empty($data->emp_num)) {
            $opportunity->emp_num = $data->emp_num;
        }
        if (!empty($data->close_date)) {
            $opportunity->close_date = \DateTime::createFromFormat('d-m-Y', $data->close_date);
        }
        if (!empty($data->stage)) {
            $opportunity->stage = $data->stage;
        }
        if (!empty($data->next_step)) {
            $opportunity->next_step = $data->next_step;
        }
        if (!empty($data->amount)) {
            $opportunity->amount = $data->amount;
        }
        if (!empty($data->currency)) {
            $opportunity->currency = $data->currency;
        }
        if (!empty($data->lead_source)) {
            $opportunity->lead_source = $data->lead_source;
        }
        if (!empty($data->compelling_event)) {
            $opportunity->compelling_event = $data->compelling_event;
        }
        if (!empty($data->user_num)) {
            $opportunity->user_num = $data->user_num;
        }
        if (!empty($data->sponsor)) {
            $opportunity->sponsor = $data->sponsor;
        }
        if (!empty($data->what_new_changed)) {
            $opportunity->what_new_changed = $data->what_new_changed;
        }
        if (!empty($data->red_flags)) {
            $opportunity->red_flags = $data->red_flags;
        }
        if (!empty($data->folder_link)) {
            $opportunity->folder_link = $data->folder_link;
        }
        if (!empty($data->competitive_position)) {
            $opportunity->competitive_position = $data->competitive_position;
        }
        if (!empty($data->progress_barometer)) {
            $opportunity->progress_barometer = $data->progress_barometer;
        }
        $opportunity->save();

        // Update opportunity sales stages
        foreach($data->all() as $key => $value) {
            if (Str::is('ss-*', $key)) {
                $ssId = Str::remove('ss-', $key);
                $salesStage = OpportunitySalesStage::where('opp_id', $id)
                                ->where('ss_id', $ssId)
                                ->get()
                                ->first();

                if ($salesStage) {
                    $salesStage->strength_indicator = $value;
                    $salesStage->save();
                } else {
                    $salesStage = new OpportunitySalesStage();
                    $salesStage->opp_id = $id;
                    $salesStage->ss_id = $ssId;
                    $salesStage->strength_indicator = $value;
                    $salesStage->save();
                }
            }
        }

        return $id;
    }
}

if (!function_exists('storeOpportunityMeddpicc')) {
    function storeOpportunityMeddpicc($data)
    {
        $oppId = $data->get('opp-id');
        $meddpicc = OpportunityMeddpicc::where('opp_id', $oppId)
                                    ->get()
                                    ->first();

        // Create new opportunity meddpicc
        if (empty($meddpicc)) {
            $opportunityMeddpicc = new OpportunityMeddpicc();
            $opportunityMeddpicc->opp_id                    = $oppId;
            $opportunityMeddpicc->metrics                   = $data->m_metrics;
            $opportunityMeddpicc->metrics_score             = $data->m_metrics_score;
            $opportunityMeddpicc->economic_buyer            = $data->m_economic_buyer;
            $opportunityMeddpicc->economic_buyer_score      = $data->m_economic_buyer_score;
            $opportunityMeddpicc->decision_criteria         = $data->m_decision_criteria;
            $opportunityMeddpicc->decision_criteria_score   = $data->m_decision_criteria_score;
            $opportunityMeddpicc->decision_process          = $data->m_decision_process;
            $opportunityMeddpicc->decision_process_score    = $data->m_decision_process_score;
            $opportunityMeddpicc->paper_process             = $data->m_paper_process;
            $opportunityMeddpicc->paper_process_score       = $data->m_paper_process_score;
            $opportunityMeddpicc->identified_pain           = $data->m_identified_pain;
            $opportunityMeddpicc->identified_pain_score     = $data->m_identified_pain_score;
            $opportunityMeddpicc->champion_coach            = $data->m_champion_coach;
            $opportunityMeddpicc->champion_coach_score      = $data->m_champion_coach_score;
            $opportunityMeddpicc->competition               = $data->m_competition;
            $opportunityMeddpicc->competition_score         = $data->m_competition_score;
            $opportunityMeddpicc->meddpicc_score            = $data->m_meddpicc_score;
            
            $opportunityMeddpicc->save();

            return $opportunityMeddpicc->id;
        }

        // Update opportunity meddpicc
        OpportunityMeddpicc::where('opp_id', $oppId)
                    ->update([
                        'metrics'                   => $data->m_metrics,
                        'metrics_score'             => $data->m_metrics_score,
                        'economic_buyer'            => $data->m_economic_buyer,
                        'economic_buyer_score'      => $data->m_economic_buyer_score,
                        'decision_criteria'         => $data->m_decision_criteria,
                        'decision_criteria_score'   => $data->m_decision_criteria_score,
                        'decision_process'          => $data->m_decision_process,
                        'decision_process_score'    => $data->m_decision_process_score,
                        'paper_process'             => $data->m_paper_process,
                        'paper_process_score'       => $data->m_paper_process_score,
                        'identified_pain'           => $data->m_identified_pain,
                        'identified_pain_score'     => $data->m_identified_pain_score,
                        'champion_coach'            => $data->m_champion_coach,
                        'champion_coach_score'      => $data->m_champion_coach_score,
                        'competition'               => $data->m_competition,
                        'competition_score'         => $data->m_competition_score,
                        'meddpicc_score'            => $data->m_meddpicc_score
                    ]);
        return $meddpicc->id;
    }
}

if (!function_exists('storeScriptMain')) {
    function storeScriptMain($data)
    {
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

if (!function_exists('storeEmailMain')) {
    function storeEmailMain($data)
    {
        $id = $data->get('id');
        
        // Create new email main
        if ($id == 0 || $id == null) {
            $emailMain          = new EmailMain();
            $emailMain->user    = Auth::user()->id;
            $emailMain->title   = $data->title;
            $emailMain->subject = $data->subject;
            $emailMain->body    = $data->body;
            
            $emailMain->save();
            return $emailMain;
        }

        // Update email main
        $emailMain = EmailMain::where('id', $id)->get()->first();
        $emailMain->title   = $data->title;
        $emailMain->subject = $data->subject;
        $emailMain->body    = $data->body;
        $emailMain->update();
        
        return $emailMain;
    }
}

if (!function_exists('deleteEmailMain')) {
    function deleteEmailMain($id)
    {
        if (empty($id)) {
            return false;
        }
        
        $result = EmailMain::where('id', $id)->delete();

        return $result;
    }
}

if (!function_exists('storeSkillMain')) {
    function storeSkillMain($data)
    {
        $id = $data->get('id');
        
        // Create new skill main
        if ($id == 0 || $id == null) {
            $skillMain          = new SkillMain();
            $skillMain->user    = Auth::user()->id;
            $skillMain->name    = $data->name;
            $skillMain->p_id    = $data->p_id;
                        
            $skillMain->save();
            return $skillMain;
        }

        // Update skill main
        $skillMain = SkillMain::where('id', $id)->get()->first();
        $skillMain->name = $data->name;
        if (!empty($data->p_id)) {
            $skillMain->p_id = $data->p_id;
        }
        
        $skillMain->update();
        
        return $skillMain;
    }
}

if (!function_exists('getAllSkills')) {
    function getAllSkills()
    {
        $user_id = Auth::user()->id;
        
        $skillMains = SkillMain::where('skills_main.user', $user_id)
                            ->where('skills_main.p_id', 0)
                            ->leftJoin('skills_main AS sm', 'sm.p_id', '=', 'skills_main.id')
                            ->groupBy('skills_main.id', 'skills_main.name')
                            ->orderBy('skills_main.id', 'ASC')
                            ->selectRaw('skills_main.id')
                            ->selectRaw('skills_main.name')
                            ->selectRaw('GROUP_CONCAT(sm.name ORDER BY sm.id ASC SEPARATOR "~!@") AS sub_skill_names')
                            ->selectRaw('GROUP_CONCAT(sm.id ORDER BY sm.id ASC SEPARATOR "~!@") AS sub_skill_ids')
                            ->get();

        $skills = [];
        
        foreach ($skillMains as $s) {
            $obj = new \stdClass();

            $obj->id = $s->id;
            $obj->name = $s->name;

            $obj->sub_skills = new \stdClass();
            $obj->sub_skills->ids = explode('~!@', $s->sub_skill_ids);
            $obj->sub_skills->names = explode('~!@', $s->sub_skill_names);
            
            $skills[] = $obj;
        }
                
        return $skills;
    }
}

if (!function_exists('deleteSkillMain')) {
    function deleteSkillMain($id)
    {
        if (empty($id)) {
            return false;
        }
        
        $sIds = SkillMain::where('user', Auth::user()->id)
                        ->where('id', $id)
                        ->orWhere('p_id', $id)
                        ->selectRaw('GROUP_CONCAT(CONCAT_WS("~!@", id)) AS ids')
                        ->get()
                        ->first();
                        
        $sIds = explode('~!@', $sIds->ids);

        $result = SkillAssessment::whereIn('s_id', $sIds)
                        ->delete();

        $result = SkillMain::where('id', $id)
                        ->orWhere('p_id', $id)
                        ->delete();
        return $result;
    }
}

if (!function_exists('getSkillAssessment')) {
    function getSkillAssessment()
    {
        $user_id = Auth::user()->id;
        $skills = SkillMain::from('skills_main AS sm')
                            ->where('sm.user', $user_id)
                            ->where('sm.p_id', '!=', 0)
                            ->leftJoin('skills_main AS sm2', 'sm.p_id', '=', 'sm2.id')
                            ->leftJoin('skills_assessment AS sa', 'sm.id', '=', 'sa.s_id')
                            ->groupBy('sm.id', 'sm.name', 'sm2.id', 'sm2.name')
                            ->orderBy('sm.id', 'ASC')
                            ->selectRaw('sm2.id AS parent_skill_id')
                            ->selectRaw('sm2.name AS parent_skill_name')
                            ->selectRaw('sm.id AS skill_id')
                            ->selectRaw('sm.name AS skill_name')
                            ->selectRaw('GROUP_CONCAT(sa.a_date ORDER BY sa.a_date ASC SEPARATOR "~!@") AS a_dates')
                            ->selectRaw('GROUP_CONCAT(sa.a_value ORDER BY sa.a_date ASC SEPARATOR "~!@") AS a_values')
                            ->get();
        
        $assessments = [];
        
        foreach ($skills as $s) {
            $obj = new \stdClass();

            $obj->parent_skill_id = $s->parent_skill_id;
            $obj->parent_skill_name = $s->parent_skill_name;
            $obj->skill_id = $s->skill_id;
            $obj->skill_name = $s->skill_name;

            $dates = explode('~!@', $s->a_dates);
            $values = explode('~!@', $s->a_values);
            $obj->assessments = [];
            for ($i = 0; $i < count($dates); $i++) {
                if (empty($dates[$i])) {
                    continue;
                }
                $obj->assessments[$dates[$i]] = $values[$i];
            }
            
            $assessments[] = $obj;
        }
                
        return $assessments;
    }
}

if (!function_exists('storeAssessment')) {
    function storeAssessment($data)
    {
        $assessment = SkillAssessment::where('s_id', $data->s_id)
                                    ->where('a_date', $data->a_date)
                                    ->get()
                                    ->first();

        if (empty($assessment)) {
            $assessment = new SkillAssessment();
            $assessment->s_id = $data->s_id;
            $assessment->a_date = $data->a_date;
            $assessment->a_value = $data->a_value;

            $assessment->save();

            return $assessment;
        }
        
        $assessment->a_value = $data->a_value;
        $assessment->update();

        return $assessment;
    }
}

if (!function_exists('getAssessmentClass')) {
    function getAssessmentClass($assessment) {
        $aClass = '';
        if ($assessment == 0) {
            $aClass = 'bg-transparent text-white';
        } elseif ($assessment > 0 && $assessment < 10) {
            $aClass = 'bg-info text-white';
        } elseif ($assessment >=10 && $assessment < 50) {
            $aClass = 'bg-danger text-white';
        } elseif ($assessment >=50 && $assessment < 70) {
            $aClass = 'bg-yellow-dark text-white';
        } elseif ($assessment >=70 && $assessment < 90) {
            $aClass = 'bg-yellow text-black';
        } else {
            $aClass = 'bg-success text-white';
        }
        
        return $aClass;
    }
}

if (!function_exists('getGroupAssessment')) {
    function getGroupAssessment()
    {
        $user_id = Auth::user()->id;
        $groups = SkillMain::from('skills_main AS sm')
                        ->where('sm.user', $user_id)
                        ->where('sm.p_id', 0)
                        ->leftJoin('skills_assessment AS sa', 'sm.id', '=', 'sa.s_id')
                        ->groupBy('sm.id', 'sm.name')
                        ->orderBy('sm.id', 'ASC')
                        ->selectRaw('sm.id, sm.name')
                        ->selectRaw('GROUP_CONCAT(sa.a_date ORDER BY sa.a_date ASC SEPARATOR "~!@") AS a_dates')
                        ->selectRaw('GROUP_CONCAT(sa.a_value ORDER BY sa.a_date ASC SEPARATOR "~!@") AS a_values')
                        ->get();

        $assessments = [];
        
        foreach ($groups as $g) {
            $obj = new \stdClass();

            $obj->id = $g->id;
            $obj->name = $g->name;

            $dates = explode('~!@', $g->a_dates);
            $values = explode('~!@', $g->a_values);
            $obj->assessments = [];
            for ($i = 0; $i < count($dates); $i++) {
                if (empty($dates[$i])) {
                    continue;
                }
                $obj->assessments[$dates[$i]] = $values[$i];
            }
            
            $assessments[] = $obj;
        }
                
        return $assessments;
    }
}

if (!function_exists('getSkillStartMonthSetting')) {
    function getSkillStartMonthSetting()
    {
        $startYear = SkillSetting::where('user', Auth::user()->id)
                                ->where('s_key', 'start_year')
                                ->get()
                                ->first();
        $startMonth = SkillSetting::where('user', Auth::user()->id)
                                ->where('s_key', 'start_month')
                                ->get()
                                ->first();

        if (empty($startYear->s_value)) {
            $startYear = date('Y');
        } else {
            $startYear = $startYear->s_value;
        }

        if (empty($startMonth->s_value)) {
            $startMonth = date('m');
        } else {
            $startMonth = $startMonth->s_value;
        }

        return $startYear . '-' . $startMonth . '-01';
    }
}

if (!function_exists('storeSkillStartAt')) {
    function storeSkillStartAt($data)
    {
        $user_id = Auth::user()->id;
        $startYear = SkillSetting::where('user', $user_id)
                                ->where('s_key', 'start_year')
                                ->get()
                                ->first();
        $startMonth = SkillSetting::where('user', $user_id)
                                ->where('s_key', 'start_month')
                                ->get()
                                ->first();

        if (empty($startYear) || empty($startMonth)) {
            $startAt = new SkillSetting();
            $startAt->user = $user_id;
            $startAt->s_key = 'start_year';
            $startAt->s_value = $data->start_year;
            $startAt->save();

            $startAt = new SkillSetting();
            $startAt->user = $user_id;
            $startAt->s_key = 'start_month';
            $startAt->s_value = $data->start_month;
            $startAt->save();
        } else {
            $startYear->s_value = $data->start_year;
            $startYear->update();

            $startMonth->s_value = $data->start_month;
            $startMonth->update();
        }

        return $data->start_year . '-' . $data->start_month . '-01';
    }
}

if (!function_exists('storeSkillACMT')) {
    function storeSkillACMT($data)
    {
        $user_id = Auth::user()->id;
        $setting = SkillSetting::where('user', $user_id)
                                            ->where('s_key', 'acmt')
                                            ->get()
                                            ->first();
        
        if (empty($setting)) {
            $setting = new SkillSetting();
            $setting->user = $user_id;
            $setting->s_key = 'acmt';
            $setting->s_value = $data->acmt;

            $setting->save();
        } else {
            $setting->s_value = $data->acmt;

            $setting->update();
        }

        return true;
    }
}

if (!function_exists('getSkillACMTSetting')) {
    function getSkillACMTSetting()
    {
        $user_id = Auth::user()->id;

        $acmt = SkillSetting::where('user', $user_id)
                            ->where('s_key', 'acmt')
                            ->get()
                            ->first();

        if (empty($acmt)) {
            return '0';
        }

        return $acmt->s_value;
    }
}

if (!function_exists('getOppInputFields')) {
    function getOppInputFields()
    {
        $userId = Auth::user()->id;

        $oppIFs = OpportunitySetting::where('user', $userId)
                                    ->where('o_key', 'input-fields')
                                    ->get();

        $ifs = config('app_setting.opportunities.input_fields');
        $results = [];
        foreach ($ifs as $key => $val) {
            $input = new \stdClass();
            $input->key = $key;
            $input->value = $val['name'];
            $input->type = $val['type'];
            $input->placeholder = $val['placeholder'];
            $input->cols = $val['cols'];
            $input->checked = false;
            foreach ($oppIFs as $o) {
                if ($o->o_value == $key) {
                    $input->checked = true;
                    break;
                }
            }
            $results[] = $input;
        }
        
        return $results;
    }
}

if (!function_exists('storeOppInputFields')) {
    function storeOppInputFields($data)
    {
        $userId = Auth::user()->id;
        $result = OpportunitySetting::where('user', $userId)
                                    ->where('o_key', 'input-fields')
                                    ->delete();

        $settings = [];

        if (empty($data) || empty($data->input_fields)) {
            return $settings;
        }

        foreach ($data->input_fields as $input) {
            $settings[] = [
                'user' => $userId,
                'o_key' => 'input-fields',
                'o_value' => $input,
                'created_at' => now()
            ];
        }

        $result = OpportunitySetting::insert($settings);
        
        return $result;
    }
}

if (!function_exists('getAllUsers')) {
    function getAllUsers()
    {
        $users = User::where('role', '!=', '-1')
                    ->get()
                    ->all();
        return $users;
    }
}

if (!function_exists('getUserRoleName')) {
    function getUserRoleName($role) {
        $roles = config('app_setting.roles');
        if (empty($roles[$role])) {
            return 'Unknown User';
        }
        return $roles[$role];
    }
}

if (!function_exists('getUserActiveClass')) {
    function getUserActiveClass($active) {
        if ($active) {
            return 'text-success';
        } else {
            return 'text-danger';
        }
    }
}

if (!function_exists('getUserActiveName')) {
    function getUserActiveName($active) {
        if ($active) {
            return 'Active';
        } else {
            return 'Inactive';
        }
    }
}

if (!function_exists('setActiveUser')) {
    function setActiveUser($id, $active = 1)
    {
        $user = User::where('id', $id)->get()->first();
        if (!empty($user)) {
            $user->active = $active;
            $user->update();
        }

        return $user;
    }
}

if (!function_exists('getUserById')) {
    function getUserById($userId)
    {
        if (empty($userId)) {
            return null;
        }

        $user = User::where('id', $userId)->get()->first();
        return $user;
    }
}

if (!function_exists('removeUser')) {
    function removeUser($id)
    {
        $user = User::where('id', $id)->get()->first();
        
        if (empty($user)) {
            return false;
        }
        
        // Change role and active
        // Not remove from table, so it is recoverable
        $user->active = 0;
        $user->role = '0';
        $user->is_first_login = 1;
        
        $user->update();

        $d_user = new \StdClass();
        $d_user->first_name = $user->first_name;
        $d_user->last_name = $user->last_name;
        $d_user->email = $user->email;
        $d_user->role = $user->role;
        $d_user->role_name = getUserRoleName($user->role);
        $d_user->active = $user->active;
        $d_user->active_name = getUserActiveName($user->active);

        return $d_user;
    }
}

if (!function_exists('callWebhook')) {
    function callWebhook($user)
    {
        // Test webhook url
        // $url = 'https://webhook.site/a149392d-bf08-495c-8caa-89112c2db5a2';

        // Real webhook url
        $url = env('WEBHOOK_URL');
        $data = [
            'status_code' => 200,
            'status' => 'success',
            'message' => 'webhook send successfully',
            'api_key' => env('WEBHOOK_API_KEY'),
            'extra_data' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email
            ],
        ];
    	$json_array = json_encode($data);
        $curl = curl_init();
        $headers = ['Content-Type: application/json'];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_array);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($http_code >= 200 && $http_code < 300) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('storeUserPassword')) {
    function storeUserPassword($data)
    {
        $password = $data->get('password');
        if (empty($password)) {
            return false;
        }
        
        // Update user password
        $user = User::where('id', Auth::user()->id)->get()->first();

        if (empty($user)) {
            return false;
        }
        
        $user->password = Hash::make($password);
        $user->update();
        
        return true;
    }
}

if (!function_exists('updateUser')) {
    function updateUser($data)
    {
        $userId = $data->get('id');
        if (empty($userId)) {
            return false;
        }
        
        // Update user
        $user = User::where('id', $userId)->get()->first();

        if (empty($user)) {
            return false;
        }
        
        $user->role = $data->get('role');
        $user->active = $data->get('active');
        $user->update();

        $u_user = new \StdClass();
        $u_user->role = $user->role;
        $u_user->role_name = getUserRoleName($user->role);
        $u_user->active = $user->active;
        $u_user->active_name = getUserActiveName($user->active);
        $u_user->active_class = getUserActiveClass($user->active);
        
        return $u_user;
    }
}

if (!function_exists('storeOppSalesStageSettings')) {
    function storeOppSalesStageSettings($data)
    {
        $userId = Auth::user()->id;
        $ssn = $data->get('ssn');
        $ssi = $data->get('ssi');

        if (!isset($data->id)) {
            // insert
            $salesStage = OpportunitySetting::where('user', $userId)
                                            ->where('o_key', 'sales-stage')
                                            ->where('o_value', $ssn)
                                            ->get()
                                            ->first();

            if ($salesStage) {
                return null;
            }

            $salesStage = new OpportunitySetting();
            $salesStage->user = $userId;
            $salesStage->o_key = 'sales-stage';
            $salesStage->o_value = $ssn;
            $salesStage->o_value1 = $ssi;
            $salesStage->save();

            $result = new \stdClass();
            $result->id = $salesStage->id;
            $result->ssn = $salesStage->o_value;
            $result->ssi = $salesStage->o_value1;
        } else {
            // update
            $id = $data->get('id');
            $salesStage = OpportunitySetting::where('user', $userId)
                                                ->where('o_key', 'sales-stage')
                                                ->where('o_value', $ssn)
                                                ->get()
                                                ->first();
            if ($salesStage != null && $salesStage->id != $id) {
                return null;
            }

            $salesStage = OpportunitySetting::where('id', $id)
                                                ->get()
                                                ->first();
            $salesStage->o_value = $ssn;
            $salesStage->o_value1 = $ssi;

            $salesStage->update();

            $result = new \stdClass();
            $result->id = $salesStage->id;
            $result->ssn = $salesStage->o_value;
            $result->ssi = $salesStage->o_value1;
        }
        
        return $result;
    }
}

if (!function_exists('getOppSalesStagesSettings')) {
    function getOppSalesStagesSettings($show = null)
    {
        if ($show == null) {
            $salesStages = OpportunitySetting::where('user', Auth::user()->id)
                                            ->where('o_key', 'sales-stage')
                                            ->select('id', 'o_value', 'o_value1')
                                            ->get();
        } else {
            $salesStages = OpportunitySetting::where('user', Auth::user()->id)
                                            ->where('o_key', 'sales-stage')
                                            ->where('o_value1', $show)
                                            ->select('id', 'o_value', 'o_value1')
                                            ->get();
        }
        
        return $salesStages;
    }
}

if (!function_exists('deleteOppSalesStageSettings')) {
    function deleteOppSalesStageSettings($data)
    {
        $result = OpportunitySetting::find($data->id)->delete();

        // Remove sales stage value associated with this id
        OpportunitySalesStage::where('ss_id', $data->id)->delete();

        return $result;
    }
}