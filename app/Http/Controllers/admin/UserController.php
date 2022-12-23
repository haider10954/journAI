<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_listing()
    {
        $user = User::latest()->paginate(6);
        return view('admin.user', compact('user'));
    }

    public function delete_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $filePath = storage_path('app/public/user/' . $user->photo);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $user = User::where('id', $request->id)->delete();
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong Please try again',
            ]);
        }
    }
}
