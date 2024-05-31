<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    //  access modifiers -> public, protected, private

    public function login(Request $request){
        return view('Auth.login');
    }


    public function userLogin(Request $request) {
        dd(request()->all());
    }

    public function register(Request $request){
        return view('Auth.register');
    }

    public function userRegister() {
        $request = request();
        $rules = [
            'first_name' => 'required|min:3|max:30',
            'last_name'  => 'required|min:3|max:30',
            'email'      => 'required|email',
            'password'   => 'required|min:8',
        ];
        $custom_messages = [
            "first_name.required" => "First name can not be null"
        ];
        $validated = $request->validate($rules, $custom_messages);
        // dd($validated);
        // request();
        // $validated = $request->validate([
        //     // 'title' => 'required|unique:posts|max:255',
        //     // 'body' => 'required',

        //     'first_name' => 'required|min:3|max:30',
        //     'last_name'  => 'required|min:3|max:30',
        //     'email'      => 'required|email',
        // ],
        // // Custom Messages
        // [
        //     'first_name.required' => 'First name is missing',
        //     'last_name.required'  => 'Last name is required',
        //     'email.required'      => 'Email is required',
        //     'first_name.min'      => 'First name must be at least 3 characters',    
        // ]
        // );

        $student = new Student;
        
        $student->first_name    = $request->first_name;  
        $student->last_name     = $request->last_name;  
        $student->email         = $request->email;  
        $student->password      = $request->password;

        if($student->save()):
            return back()->withSuccess("Student Record is created");
        endif;
        // dd( $student->user );
    }
}
