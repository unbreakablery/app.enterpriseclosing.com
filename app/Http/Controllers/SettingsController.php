<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Action;
use App\Models\Setting;
use App\Models\SuggestSetting;
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
        $actions = Action::get();
        $steps = Step::get();
        $settings = Setting::where('user_id', $user_id)->get();
        $suggestSettings = SuggestSetting::where('user_id', $user_id)->get();
        $step_setting = Setting::where('user_id', $user_id)
                        ->where('section_type', 2)->get();

        return view('pages.settings', compact('actions', 'steps', 'suggestSettings', 'settings', 'step_setting'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        
        Setting::where('user_id', $user_id)
                ->delete();
        SuggestSetting::where('user_id', $user_id)->delete();
        
        if($request->actions != null){
            foreach ($request->actions as $action) {
                $insert_action = new Setting;
                $insert_action->user_id = $user_id;
                $insert_action->section_type = 1;
                $insert_action->section_id = $action;
                $insert_action->save();
            }
        }
        if($request->steps != null){
            foreach ($request->steps as $step) {
                $insert_step = new Setting;
                $insert_step->user_id = $user_id;
                $insert_step->section_type = 2;
                $insert_step->section_id = $step;
                $insert_step->save();
            }
        }
        if($request->suggest_steps != null){
            foreach ($request->suggest_steps as $suggest_step) {
                $split_suggest_step = explode(":", $suggest_step);
                $insert_step = new SuggestSetting;
                $insert_step->user_id = $user_id;
                $insert_step->step_id = $split_suggest_step[0];
                $insert_step->suggest_step_id = $split_suggest_step[1];
                $insert_step->save();
            }
        }
        return redirect()->back()->with('success', 'Saved');
    }
}
