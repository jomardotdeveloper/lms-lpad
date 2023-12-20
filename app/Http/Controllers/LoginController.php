<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view("single-pages.login");
    }
    public function register(){
        $departments = Department::all();
        $sections = Section::all();
        return view("single-pages.register" , compact('departments' , 'sections'));
    }
    public function authenticate(Request $request){
        $validated = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // check if user account is activated
        $user = User::where("email", $validated["email"])->first();

        if ($user) {
            if (!$user->is_activated) {
                return back()->withErrors([
                    'email' => 'Your account is not activated yet.',
                ]);
            }
        }


        if (Auth::attempt($validated, true)) {

            if($user->contact->is_admin) {
                $this->createLog('Admin logged in', $user, true);
            }else{
                $this->createLog('User logged in', $user, false);
            }
            $request->session()->regenerate();
            return redirect()->intended("/admin/dashboard");
        }




        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registerStore(Request $request){
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $data['user_id'] = $user->id;


        if($data['account_type'] == "student") {
            $data['is_student'] = true;
        } else {
            $data['is_student'] = false;
        }

        if($data['account_type'] == "teacher") {
            $data['is_teacher'] = true;
        } else {
            $data['is_teacher'] = false;
        }

        if($request->hasFile('profile_picture')) {
            $path = $this->uploadFile($request, 'profile_picture', 'profile-pictures');
            $data['profile_picture'] = $path;
        }
        $contact = Contact::create($data);

        return redirect()->route("login");
    }

    public function logout(Request $request)
    {
        if(auth()->user()->contact->is_admin) {
            $this->createLog('Admin logged out', auth()->user(), true);
        }else{
            $this->createLog('User logged out', auth()->user(), false);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();



        return redirect()->route("login");
    }

}
