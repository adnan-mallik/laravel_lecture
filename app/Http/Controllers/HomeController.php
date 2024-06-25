<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Abc;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //  access modifiers -> public, protected, private

    /**
     * 
     * 
     * =============================================
     *            Login
     * =============================================
     * 
     */
    public function login(Request $request){
        return view('Auth.login');
    }

    /**
     * 
     * 
     * =============================================
     *            Login
     * =============================================
     * 
     */
    public function userLogin(Request $request) {
        dd(request()->all());
    }

    /**
     * 
     * 
     * =============================================
     * @return view('Auth.register')
     * =============================================
     * 
     */
    public function register(Request $request){
        return view('Auth.register');
    }

    /**
     * 
     * 
     * =============================================
     *  @return json_response
     * =============================================
     * 
     */
    public function userRegister(Request $request) {

        // return response()->json([
        //     "status"  => "error",
        //     "message" => "this is error message"
        // ]);
        // $request = request()->all();

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

        $validator = Validator::make($request->all(), $rules, $custom_messages); // scope resulution operator
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
        // $student = Student::firstOrNew(['email' => $validated["email"]]);
        // $student = new Student;
        
        // $student->first_name    = $validated["first_name"];  
        // $student->last_name     = $validated["last_name"];
        // $student->email         = $validated["email"];  
        // $student->password      = $validated["password"];
        // $data = [
        //     "first_name"    =>  $validated["first_name"],
        //     "last_name"     =>  $validated["last_name"],
        //     "email"         =>  $validated["email"],
        //     "password"      =>  $validated["password"]
        // ];
        // dd($validated);
        if(  Student::create($validated) ):
            // return back()->withSuccess("Student Record is created");

            return response()->JSON([
                "status"  => "success",
                "message" => "student created"
            ]);
        endif;
        // dd( $student->user );
    }

    /**
     * 
     * 
     * =============================================
     *  @return view('students')
     * =============================================
     * 
     */
    public function students() {
        $students = Student::all();
        // dd($students);
        return view('students.students', compact('students'));
    }
}
