<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScriptMain;
use Auth;

class ScriptController extends Controller
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

    public function getScripts()
    {
        $user_id = Auth::user()->id;

        $data = [];
        $scriptMains = ScriptMain::where('user', $user_id)
                                ->get();

        foreach ($scriptMains as $scriptMain) {
            $temp = new \stdClass();
            $temp->main = $scriptMain;
           
            $data[] = $temp;
        }

        $nl_scripts_class = 'active';
        
        return view('pages.scripts', compact('data', 'nl_scripts_class'));
    }

    public function removeScriptMain(Request $request)
    {
        $id = $request->id;
        $result = deleteScriptMain($id);
        return response()->json([
            'success' => $result
        ]);
    }
}
