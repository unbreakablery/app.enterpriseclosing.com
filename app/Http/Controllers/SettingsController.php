<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Step;
use App\Models\Action;
use App\Models\TaskSetting;
use App\Models\TaskSuggestSetting;
use App\Models\ScriptMain;
use App\Models\EmailMain;
use App\Models\SkillMain;
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
        $userId = Auth::user()->id;
        $actions = Action::where('is_other', '0')->orderBy('name', 'ASC')->get();
        $steps = Step::where('is_other', '0')->orderBy('name', 'ASC')->get();
        $taskSettings = TaskSetting::where('user_id', $userId)->get();
        $suggestSettings = TaskSuggestSetting::where('user_id', $userId)->get();
        $stepSetting = TaskSetting::where('user_id', $userId)
                                ->where('section_type', 2)->get();
        $scriptSetting = ScriptMain::where('user', $userId)->get();
        $emailSetting = EmailMain::where('user', $userId)->get();
        $skillSetting = getAllSkills();

        $skillStartAt = getSkillStartMonthSetting();
        $skillStartAt = Carbon::parse($skillStartAt);

        $skillACMT = getSkillACMTSetting();

        $user = User::where('id', $userId)->get()->first();

        $oppIFs = getOppInputFields();

        $salesStages = getOppSalesStagesSettings();

        return view('pages.settings', compact(
                'actions', 
                'steps', 
                'suggestSettings', 
                'taskSettings', 
                'stepSetting',
                'user',
                'scriptSetting',
                'emailSetting',
                'skillSetting',
                'skillStartAt',
                'skillACMT',
                'oppIFs',
                'salesStages'
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
            // 'password' => 'required_with:password_confirmation|same:password_confirmation',
            // 'password_confirmation' => 'same:password',
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

    public function storeEmailSettings(Request $request)
    {
        $email = storeEmailMain($request);

        return response()->json([
            'email' => $email
        ]);
    }

    public function storeSkillMainSettings(Request $request)
    {
        $skill = storeSkillMain($request);
        
        $skills = getAllSkills();

        return response()->json([
            'skill' => $skill,
            'skills' => $skills
        ]);
    }

    public function storeSkillStartAtSettings(Request $request)
    {
        $startAt = storeSkillStartAt($request);
        $startAt = Carbon::parse($startAt);

        return response()->json([
            'year' => $startAt->year,
            'month' => $startAt->format('F')
        ]);
    }

    public function storeSkillACMTSettings(Request $request)
    {
        $acmt = storeSkillACMT($request);
                
        return response()->json([
            'success' => $acmt
        ]);
    }

    public function storeOppIFsSettings(Request $request)
    {
        $result = storeOppInputFields($request);

        return response()->json([
            'success' => $result
        ]);
    }

    public function removeCurrentUser()
    {
        // Call webhook
        if (callWebhook(Auth::user())) {
            // Remove user
            $user = removeUser(Auth::user()->id);

            // Logout automatically
            Auth::logout();
            return redirect('/login');
        }

        return redirect()->back()->withErrors([
            'errors' => 'Failed to call webhook for deleting your account, Retry later!'
        ]);
    }

    public function storePassword(Request $request)
    {
        $result = storeUserPassword($request);

        if ($result) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function storeOppSalesStageSettings(Request $request)
    {
        $salesStage = storeOppSalesStageSettings($request);

        if ($salesStage) {
            return response()->json([
                'success' => true,
                'sales_stage' => $salesStage
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        } 
    }

    public function updateOppSalesStageSettings(Request $request)
    {
        $salesStage = storeOppSalesStageSettings($request);

        if ($salesStage) {
            return response()->json([
                'success' => true,
                'sales_stage' => $salesStage
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        } 
    }

    public function removeOppSalesStageSettings(Request $request)
    {
        $result = deleteOppSalesStageSettings($request);

        return response()->json([
            'success' => $result
        ]);
    }
}
