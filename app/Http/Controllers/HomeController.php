<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Action;
use App\Models\Step;
use App\Models\Setting;
use App\Models\SuggestSetting;

use Auth;

class HomeController extends Controller
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

    public function tasks(Request $request)
    {   
        if (Auth::user()->role == '2') {
            User::where('id', Auth::user()->id)
                ->update(['role' => '1']);
            return redirect()->route('settings');
        }

        $actions = Action::get();
        $steps = Step::get();
        $settings = Setting::where('user_id', Auth::user()->id)
                            ->get();

        $tasks = Task::where([
                                ['status', '=', '0'],
                                ['user', '=', Auth::user()->id]
                            ])
                        ->join('actions', 'actions.id', '=', 'tasks.action')
                        ->join('steps', 'steps.id', '=', 'tasks.step')
                        ->select('tasks.*', 'actions.name AS action_name', 'steps.name AS step_name')
                        ->orderBy('by_date', 'ASC')
                        ->get()
                        ->all();
        
        $nl_tasks_class = 'active';
        $user_action = (isset($request->user_action)) ? $request->user_action : '';
        $saved_step = old('saved_step');
        $suggest_person_account = (isset($request->person_account)) ? $request->person_account : '';
        $suggest_opportunity = (isset($request->opportunity)) ? $request->opportunity : '';
        
        //get suggested steps for additional tasks
        $suggest_steps = SuggestSetting::where('user_id', Auth::user()->id)
                                ->where('step_id', (!empty($saved_step)) ? $saved_step : 0)
                                ->join('steps', 'suggest_settings.suggest_step_id', '=', 'steps.id')
                                ->select('steps.id', 'steps.name')
                                ->distinct('steps.id')
                                ->orderBy('steps.name')
                                ->get();
        $suggest_actions = Setting::where('user_id', Auth::user()->id)
                                ->where('section_type', 1)
                                ->join('actions', 'settings.section_id', '=', 'actions.id')
                                ->select('actions.id', 'actions.name')
                                ->distinct('actions.id')
                                ->orderBy('actions.name')
                                ->get();
        
        return view('pages.tasks', 
                    compact(
                        'actions',
                        'steps',
                        'settings',
                        'tasks',
                        'nl_tasks_class',
                        'user_action',
                        'suggest_steps',
                        'suggest_actions',
                        'suggest_person_account',
                        'suggest_opportunity'
                    )
        );
    }

    public function outbound()
    {
        return view('pages.outbound', [
            'nl_outbound_class' => 'active'
        ]);
    }

    public function opportunities()
    {
        return view('pages.opportunities', [
            'nl_opportunities_class' => 'active'
        ]);
    }

    public function scripts()
    {
        return view('pages.scripts', [
            'nl_scripts_class' => 'active'
        ]);
    }

    public function emails()
    {
        return view('pages.emails', [
            'nl_emails_class' => 'active'
        ]);
    }

    public function contacts()
    {
        return view('pages.contacts', [
            'nl_contacts_class' => 'active'
        ]);
    }

    public function resources()
    {
        return view('pages.resources', [
            'nl_resources_class' => 'active'
        ]);
    }

    public function skills()
    {
        return view('pages.skills', [
            'nl_skills_class' => 'active'
        ]);
    }

    public function analytics()
    {
        return view('pages.analytics', [
            'nl_analytics_class' => 'active'
        ]);
    }

    
}
