<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Mail\WebhookMail;
use App\Models\User;

class UserController extends Controller
{
    public function createNewUser(Request $request) {
        // Validate for request
        if (empty($request->api_key) || $request->api_key != env('WEBHOOK_API_KEY')) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Invalid API Key'
            ]);
        }

        if (empty($request->first_name) || strlen($request->first_name) > 255) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'First Name is required and max length is 255.'
            ]);
        }

        if (empty($request->last_name) || strlen($request->last_name) > 255) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Last Name is required and max length is 255.'
            ]);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Invalid Email Address'
            ]);
        } else {
            $user = User::where('email', $request->email)->get()->first();
            if (!empty($user)) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'Duplicated Email Address'
                ]);
            }
        }

        $name = $request->first_name . ' ' . $request->last_name;
        $email = $request->email;
        // $password = env('WEBHOOK_USER_PASSWORD');
        $password = Str::random(32);
        
        // Create new user
        $user = new User();
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = '3';
        $user->active = 1;
        $user->is_first_login = 1;
        
        $user->save();

        try {
            // Send Email with generated password
            Mail::to($email)->send(new WebhookMail($name, $password));
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'New user account was created successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Error while sending mail, please retry later!'
            ]);
        }
    }
}
