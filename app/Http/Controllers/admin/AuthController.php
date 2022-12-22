<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{
    public  function index()
    {
        return view('admin.login');
    }
    public function admin_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => true,
                'message' => 'You are Logged in successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is invalid',
            ]);
        }
    }

    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }
}
