<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\College;
use App\Department;
use App\Course;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function vewChangeUserType()
    {
        $users = User::whereNotIn('user_type', ['student'])->get();

        $data['users'] = $users;
        
        return view('access.access', $data);
    }

    public function changeUserType(Request $request)
    {
        $user = User::find($request->user_id);
        $user->user_type = $request->user_type;
        $user->save();
        return redirect()->back()->with(['flash_message' => 'Successfully changed user access', 'type' => 'success']);
    }

    public function viewProfile()
    {
        $user = Auth::user();
        $colleges = College::get();  
        $departments = Department::get();
        $courses = Course::get();

        $data['user'] = $user;
        $data['colleges'] = $colleges;
        $data['departments'] = $departments;
        $data['courses'] = $courses;

        return view('profile.profile', $data);
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        
        if($request->input('password') != null){
            $user->password = bcrypt($request->input('password'));   
        }

        if($request->has('matriculation_number')){
            $user->matriculation_number = $request->input('matriculation_number');
        }

        if($request->has('staff_id')){
            $user->staff_id = $request->input('staff_id');
        }

        if($request->has('college')){
            $user->college = $request->input('college');
        }

        if($request->has('department')){
            $user->department = $request->input('department');
        }

        if($request->has('course')){
            $user->course = $request->input('course');
        }

        if($request->has('final_year')){
            $user->final_year = $request->input('final_year');
        }

        if($request->has('level')){
            $user->level = $request->input('level');
        }

        $user->save();
        
        return redirect()->back()->with(['flash_message' => 'Profile update was successful', 'type' => 'success']);   
    }
}
