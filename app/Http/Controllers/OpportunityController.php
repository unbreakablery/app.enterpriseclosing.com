<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpportunityMain;
use App\Models\OpportunityMeddpicc;
use App\Models\OpportunitySetting;
use App\Models\Task;
use Auth;

class OpportunityController extends Controller
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

    public function getOpportunities()
    {
        $user_id = Auth::user()->id;

        $data = [];
        $oppMains = OpportunityMain::where('user', $user_id)
                                    ->get();

        foreach ($oppMains as $oppMain) {
            $oppMeddpicc = OpportunityMeddpicc::where('opp_id', $oppMain->id)
                                            ->get()
                                            ->first();
            $tasks = Task::where([
                                    ['tasks.status', '=', '0'],
                                    ['tasks.user', '=', Auth::user()->id],
                                    ['tasks.opportunity', '=', $oppMain->id]
                                ])
                            ->join('actions', 'actions.id', '=', 'tasks.action')
                            ->join('steps', 'steps.id', '=', 'tasks.step')
                            ->leftJoin('opportunities_main', 'opportunities_main.id', '=', 'tasks.opportunity')
                            ->select('tasks.*', 'actions.name AS action_name', 'steps.name AS step_name', 'opportunities_main.opportunity AS opportunity_name')
                            ->orderBy('by_date', 'ASC')
                            ->get()
                            ->all();

            $temp = new \stdClass();
            $temp->main = $oppMain;
            $temp->tasks = $tasks;
            $temp->meddpicc = $oppMeddpicc;
            $temp->salesStages = OpportunitySetting::from('opportunities_settings AS os')
                                    ->where([
                                                ['os.user', '=', Auth::user()->id],
                                                ['os.o_key', '=', 'sales-stage'],
                                                ['os.o_value1', '=', 1]
                                            ])
                                    ->leftJoin('opportunities_sales_stage AS oss', function($join) use ($oppMain) {
                                            $join->on('oss.ss_id', '=', 'os.id')
                                                ->where('oss.opp_id', '=', $oppMain->id);
                                        })
                                    ->orderBy('os.id')
                                    ->select('os.id', 'os.o_value AS snn', 'oss.strength_indicator AS si')
                                    ->get()
                                    ->all();
            $data[] = $temp;
        }

        $actions = getActionsForCurrentUser();
        $steps = getStepsForCurrentUser();

        $opportunityIfs = getOppInputFields();

        $nl_opportunities_class = 'active';

        return view('pages.opportunities',
                    compact(
                            'data',
                            'actions',
                            'steps',
                            'opportunityIfs',
                            'nl_opportunities_class'
                    )
                );
    }

    public function saveOpportunityMain(Request $request)
    {
        $id = storeOpportunityMain($request);
        
        return response()->json([
            'id' => $id
        ]);
    }

    public function updateOpportunityMain(Request $request)
    {
        $id = storeOpportunityMain($request);
        
        return redirect(url()->previous())->withInput();
    }

    public function saveOpportunityMeddpicc(Request $request)
    {
        $id = storeOpportunityMeddpicc($request);
        
        return redirect(url()->previous())->withInput();
    }

    public function saveTask(Request $request)
    {
        $action             = $request->action;
        $step               = $request->step;
        $person_account     = $request->person_account;
        $opportunity        = empty($request->opportunity) ? 0 : $request->opportunity;
        $note               = $request->note;
        $by_date            = $request->by_date;
        $priority           = $request->priority;

        $task = storeTask($action, $step, $person_account, $opportunity, $note, $by_date, $priority);

        // Get suggest settings
        $suggest = new \stdClass();
        $suggest->actions = getActionsForCurrentUser();
        $suggest->old_action = $action;
        $suggest->steps = getSuggestSteps($step);
        $suggest->person_account = (!empty($person_account)) ? $person_account : '';
        $suggest->opportunities = getOpportunities();
        $suggest->old_opportunity = $opportunity;
        $suggest->by_date = $by_date;
        $suggest->priority = $priority;

        return response()->json([
            'taskID' => $task->id,
            'suggest' => $suggest
        ]);
    }

    public function saveOpportunity(Request $request)
    {
        $mainId = storeOpportunityMain($request);
        $meddpiccId = storeOpportunityMeddpicc($request);

        return redirect(url()->previous())->withInput();
    }
}
