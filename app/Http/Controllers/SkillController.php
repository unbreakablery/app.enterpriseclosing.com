<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkillMain;
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
}
