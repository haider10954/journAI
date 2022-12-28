<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Service\NotificationHandler;

class AuthController extends Controller
{
    public function admin_profile()
    {
        return view('admin.setting');
    }
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


    function upload_files($file, $oldName = null)
    {
        if (empty($file)) {
            return $oldName;
        }
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/admin/profile', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }



    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'full_name' => 'required',
            'image' => 'mimes:png,jpg,jpeg',

        ]);
        $admin_profile_photo = $this->upload_files($request['image'] ?? null, auth('admin')->user()->image);
        $admin = Admin::where('id', auth('admin')->id())->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'full_name' => $request['full_name'],
            'image' => $admin_profile_photo,
        ]);

        if ($admin) {
            return response()->json([
                'success' => true,
                'message' => 'Your Profile has been updated successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong Please try again',
            ]);
        }
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'oldpasswordInput' => 'required',
            'newpasswordInput' => 'required|same:confirmpasswordInput',
        ]);
        if ((Hash::check($request->oldpasswordInput, auth('admin')->user()->password))) {
            $admin = Admin::where('id', auth('admin')->id())->update([
                'password' => Hash::make($request['newpasswordInput']),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'The entered password is not valid'
            ]);
        }
        if ($admin) {
            return response()->json([
                'success' => true,
                'message' => 'Password has been updated successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong Please try again'
            ]);
        }
    }

    public function index_page()
    {
        $user = User::get()->count();
        $notes = Note::get()->count();
        return view('admin.index', compact('user', 'notes'));
    }

    public function markAsRead()
    {
        NotificationHandler::markAsRead();
        return redirect()->back();
    }

    public function markAllAsRead()
    {
        NotificationHandler::markAllAsRead();
        return redirect()->back();
    }
}
