<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailMain;
use Auth;

class EmailController extends Controller
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

    public function getEmails()
    {
        $user_id = Auth::user()->id;

        $data = [];
        $emailMains = EmailMain::where('user', $user_id)
                                ->get();

        foreach ($emailMains as $emailMain) {
            $temp = new \stdClass();
            $temp->main = $emailMain;
           
            $data[] = $temp;
        }

        $nl_emails_class = 'active';
        
        return view('pages.emails', compact('data', 'nl_emails_class'));
    }

    public function removeEmailMain(Request $request)
    {
        $id = $request->id;
        $result = deleteEmailMain($id);
        return response()->json([
            'success' => $result
        ]);
    }

    public function saveEmailMain(Request $request)
    {
        $email = storeEmailMain($request);

        return response()->json([
            'email' => $email
        ]);
    }
}
