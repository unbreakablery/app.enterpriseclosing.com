<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutboundMain;
use App\Models\OutboundPerson;
use Auth;

class OutboundController extends Controller
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
    
    public function getOutbound()
    {
        $user_id = Auth::user()->id;

        $data = [];
        $outboundMains = OutboundMain::where('user', $user_id)
                                    ->get();

        foreach ($outboundMains as $outboundMain) {
            $outboundPersons = OutboundPerson::where('o_id', $outboundMain->id)
                                            ->get();
            $temp = new \stdClass();
            $temp->main = $outboundMain;
            $temp->persons = $outboundPersons;
            $data[] = $temp;
        }

        $nl_outbound_class = 'active';
        return view('pages.outbound', compact('data', 'nl_outbound_class'));
    }

    public function saveOutboundMain(Request $request)
    {
        $id = storeOutboundMain($request);
        
        return response()->json([
            'id' => $id
        ]);
    }

    public function saveOutboundPerson(Request $request)
    {
        $id = storeOutboundPerson($request);
        
        return response()->json([
            'id' => $id
        ]);
    }

    public function removeOutboundMain(Request $request)
    {
        $result = deleteOutboundMain($request->id);
        
        return response()->json([
            'result' => $result
        ]);
    }

    public function removeOutboundPerson(Request $request)
    {
        $result = deleteOutboundPerson($request->id);
        
        return response()->json([
            'result' => $result
        ]);
    }
}
