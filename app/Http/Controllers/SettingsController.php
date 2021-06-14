<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Step;
use App\Models\Action;
use App\Models\TaskSetting;
use App\Models\TaskSuggestSetting;
use App\Models\ScriptMain;
use App\Models\User;
use Auth;

class SettingsController extends Controller
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
    
    public function index()
    {
        $user_id = Auth::user()->id;
        $actions = Action::where('is_other', '0')->orderBy('name', 'ASC')->get();
        $steps = Step::where('is_other', '0')->orderBy('name', 'ASC')->get();
        $taskSettings = TaskSetting::where('user_id', $user_id)->get();
        $suggestSettings = TaskSuggestSetting::where('user_id', $user_id)->get();
        $stepSetting = TaskSetting::where('user_id', $user_id)
                                ->where('section_type', 2)->get();
        $scriptSetting = ScriptMain::where('user', $user_id)->get();

        $user = User::where('id', Auth::user()->id)->get()->first();

        return view('pages.settings', compact(
                'actions', 
                'steps', 
                'suggestSettings', 
                'taskSettings', 
                'stepSetting',
                'user',
                'scriptSetting'
            )
        );
    }

    public function storeTasksSettings(Request $request)
    {
        $user_id = Auth::user()->id;
        
        TaskSetting::where('user_id', $user_id)
                ->delete();
        TaskSuggestSetting::where('user_id', $user_id)->delete();
        
        if($request->actions != null){
            foreach ($request->actions as $action) {
                $insert_action = new TaskSetting;
                $insert_action->user_id = $user_id;
                $insert_action->section_type = 1;
                $insert_action->section_id = $action;
                $insert_action->save();
            }
        }
        if($request->steps != null){
            foreach ($request->steps as $step) {
                $insert_step = new TaskSetting;
                $insert_step->user_id = $user_id;
                $insert_step->section_type = 2;
                $insert_step->section_id = $step;
                $insert_step->save();
            }
        }
        if($request->suggest_steps != null){
            foreach ($request->suggest_steps as $suggest_step) {
                $split_suggest_step = explode(":", $suggest_step);
                $insert_step = new TaskSuggestSetting;
                $insert_step->user_id = $user_id;
                $insert_step->step_id = $split_suggest_step[0];
                $insert_step->suggest_step_id = $split_suggest_step[1];
                $insert_step->save();
            }
        }
        return redirect()->back()->with('success', 'Saved');
    }

    public function storeGeneralSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'same:password',
        ]);
        
        if ($validator->fails()){
            return redirect(url()->previous())->withErrors($validator)->withInput();
        }
        
        storeUser($request);
        return redirect()->route('settings');
    }

    public function storeScriptSettings(Request $request)
    {
        $script = storeScriptMain($request);

        return response()->json([
            'script' => $script
        ]);
    }
}
