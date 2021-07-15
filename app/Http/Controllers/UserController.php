<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
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
        $this->authorize('manage-user');

        $users = getAllUsers();
        
        $nl_users_class = 'active';

        return view('pages.users', 
                    compact(
                        'nl_users_class',
                        'users'
                    )
        );
    }

    public function setActiveUser(Request $request)
    {
        $userId = $request->id;
        $active = isset($request->active) ? $request->active : 1;
        $user = setActiveUser($userId, $active);
        return response()->json([
            'user' => $user
        ]);
    }

    public function removeUser(Request $request)
    {
        $userId = $request->id;
        removeUser($userId);
        return response()->json([
            'type' => 'success'
        ]);
    }
}