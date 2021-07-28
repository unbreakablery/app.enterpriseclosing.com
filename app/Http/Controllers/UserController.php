<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Get all roles
        $roles = config('app_setting.roles');
        
        $nl_users_class = 'active';

        return view('pages.users', 
                    compact(
                        'nl_users_class',
                        'users',
                        'roles'
                    )
        );
    }

    public function updateUserAccount(Request $request)
    {
        $user = updateUser($request);

        if (!empty($user)) {
            return response()->json([
                'type' => 'success',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'type' => 'failed'
            ]);
        }
    }

    public function removeUserAccount(Request $request)
    {
        $userId = $request->id;
        $user = getUserById($userId);

        // Call webhook
        if (callWebhook($user)) {
            // Remove user
            $user = removeUser($userId);

            return response()->json([
                'type' => 'success',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'type' => 'failed'
            ]);
        }
    }
}
