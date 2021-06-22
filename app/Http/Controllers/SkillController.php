<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkillMain;
use Illuminate\Support\Carbon;
use Auth;

class SkillController extends Controller
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

    public function getSkills()
    {
        $user = Auth::user();
        $assessments = getSkillAssessment();
        // dd($assessments);
        $createdAt = Carbon::create($user->created_at->year, $user->created_at->month, 1, 0);

        $now = new Carbon();
        $now = Carbon::create($now->year, $now->month, 1, 0);
        
        $diffMonths = $now->diffInMonths($createdAt);
        
        $dates = [$user->created_at->format('Y-m-d')];
        for ($i = 1; $i <= $diffMonths; $i++) {
            $dates[] = $user->created_at->addMonths($i)->format('Y-m-d');
        }
        
        foreach ($dates as $d) {
            foreach ($assessments as $a) {
                if (empty($a->assessments[$d])) {
                    $a->assessments[$d] = 0.00;
                }
            }
        }
        
        $nl_skills_class = 'active';
        
        return view('pages.skills', 
                    compact(
                        'nl_skills_class',
                        'dates',
                        'assessments'
                    )
        );
    }

    public function removeSkillMain(Request $request)
    {
        $id = $request->id;
        $result = deleteSkillMain($id);

        $skills = getAllSkills();
        
        return response()->json([
            'success' => $result,
            'skills' => $skills
        ]);
    }

    public function saveAssessment(Request $request)
    {
        $assessment = storeAssessment($request);

        return response()->json([
            'success' => true,
            'assessment' => $assessment
        ]);
    }
}
