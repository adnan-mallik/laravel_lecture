<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;;

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
        // dd(request()->all());
        $request = request()->all();
        $rules = [
            'first_name' => 'required|min:3|max:30',
            'last_name'  => 'required|min:3|max:30',
            'email'      => 'required|email|unique:students,email',
            'password'   => 'required|min:8',
        ];
        $custom_messages = [
            "first_name.required" => "First name can not be null"
        ];
        // $validated = $request->validate($rules, $custom_messages);

        $validator = Validator::make($request, $rules, $custom_messages); // scope resulution operator
        // dd($validator->fails());

        if( $validator->fails() ){
            return response()->json([
                "status"    => "errors",
                "messages"  => $validator->errors()
            ]);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

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

        // $student = new Student;
        $student = Student::firstOrNew(['email' => $validated["email"]]);
        
        // $student->first_name    = $request->first_name;  
        $student->last_name     = $validated["last_name"];
        $student->email         = $validated["email"];  
        $student->password      = $validated["password"];

        if($student->save()):
            // return back()->withSuccess("Student Record is created");

            return response()->JSON([
                "status"  => "success",
                "message" => "student created"
            ]);
        endif;
        // dd( $student->user );
    }
}
