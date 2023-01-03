<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Note;
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

            $dummy_note = Note::create([
                'user_id' => $user->id,
                'title' => 'Dummy Note Title',
                'response' => '{"predictions":{"disappointment":0.2715681791305542,"sadness":0.20725218951702118,"neutral":0.08957844972610474,"annoyance":0.0881405919790268,"disapproval":0.05938264727592468},"harassment_predictions":{"Normal":0.3852198175500092,"Harassment":0.6147801824499908},"suggestions":"default"}',
                'analytics' => '{"disappointment":0.2715681791305542,"sadness":0.20725218951702118,"neutral":0.08957844972610474,"annoyance":0.0881405919790268,"disapproval":0.05938264727592468}',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
            ]);

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
            'profile_img' => 'mimes:jpeg,png,jpg',
            'gender' => 'required',
        ]);

        $hobby = collect(json_decode($request->hobbies))->pluck('value');
        if ($request->hasFile('profile_img')) {
            $file = $this->upload_files($request['profile_img']);
        } else {
            $file =  auth()->user()->photo;
        }

        $user = User::where('id', auth()->id())->update([
            'Username' => $request['name'],
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'Job_designation' => $request['Job_designation'],
            'company_name' => $request['company_name'],
            'address' => $request['address'],
            'hobbies' => $hobby,
            'photo' => $file,
            'gender' => $request['gender'],
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

    public function update_tour_status()
    {
        $user = User::where('id', auth()->id())->update([
            'tour_status' => 1
        ]);
        if ($user) {
            return json_encode(
                [
                    'success' => true,
                    'message' => 'Tour status updated',
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
