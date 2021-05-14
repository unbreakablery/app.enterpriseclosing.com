<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Tasks::where([
                                ['status', '=', '0'],
                                ['user', '=', Auth::user()->id]
                            ])
                        ->orderBy('by_date', 'ASC')
                        ->get()
                        ->all();

        return view('pages.tasks', [
            'nl_tasks_class'    => 'active',
            'tasks'             => $tasks
        ]);
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

    public function settings()
    {
        return view('pages.settings', [
            
        ]);
    }
}
