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

    public function update_user($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.user_update', compact('user'));
    }

    function upload_files($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/user/', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'email',
            'Job_designation' => 'required',
            'company_name' => 'required',
            'hobbies' => 'required',
            'address' => 'required',
            'profile_img' => 'mimes:jpeg,png,jpg'
        ]);

        $hobby = collect(json_decode($request->hobbies))->pluck('value');
        if ($request->hasFile('profile_img')) {
            $file = $this->upload_files($request['profile_img']);
        } else {
            $file =  auth()->user()->photo;
        }

        $user = User::where('id', $request->id)->update([
            'Username' => $request['name'],
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'Job_designation' => $request['Job_designation'],
            'company_name' => $request['company_name'],
            'address' => $request['address'],
            'hobbies' => $hobby,
            'photo' => $file,
        ]);
        if ($user) {
            return json_encode(
                [
                    'success' => true,
                    'message' => 'User profile has been Updated.'
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
