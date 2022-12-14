<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return json_encode([
                'success' => true,
                'message' => 'Login Successfully'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Email or Password is Incorrect'
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('user_login');
    }

    public function user_signUp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:confirm_password',
        ]);
        $user = User::create([
            'Username' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            return json_encode(
                [
                    'success' => true,
                    'message' => 'User has been registered successfully.'
                ]
            );
        } else {
            return json_encode(
                [
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ]
            );
        }
    }
}
