<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpportunityMain;
use App\Models\OpportunityMeddpicc;
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
            
            $data[] = $temp;
        }

        $actions = getActions();
        $steps = getSteps();

        $nl_opportunities_class = 'active';
        
        return view('pages.opportunities',
                    compact(
                            'data',
                            'actions',
                            'steps',
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
}
