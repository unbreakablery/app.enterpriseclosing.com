<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpportunityMain;
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
            // $outboundPersons = OutboundPerson::where('o_id', $outboundMain->id)
            //                                 ->get();
            $temp = new \stdClass();
            $temp->main = $oppMain;
            // $temp->persons = $outboundPersons;
            $data[] = $temp;
        }

        $nl_opportunities_class = 'active';
        
        // $actions = getActions();
        // $steps = getSteps();

        return view('pages.opportunities', compact('data', 'nl_opportunities_class'));
    }

    public function saveOpportunityMain(Request $request)
    {
        $id = storeOpportunityMain($request);
        
        return response()->json([
            'id' => $id
        ]);
    }
}
