<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function(){
    // what is closure?

    // dd("this is home route");

    $a = 10;
    $b = 20;


    dd( "The sum of $a and $b = ". ($a + $b) );

    $var = "this is variable";
});


// Route::get('student', function(){
    
//     return view('student');
// });

// Route::view('student', 'student');


Route::get('student/{id}', function($id){

    $students   =   collect([
        ['id'    =>  1,'name'  =>  'John'],
        ['id'    =>  2,'name'  =>  'Joe'],
        ['id'    =>  3,'name'  =>  'Jill'],
        ['id'    =>  4,'name'  =>  'Jane'],
        ['id'    =>  5,'name'  =>  'Jenny'],
    ]);

    return $students->where('id', $id)->first() ?? abort(404);

    // $a = 10;
    
    // return $a == 10 ? 'number is 10' : 'number is not 10';
    // return $a == 10 ?? 'number is 10';

    // syntax - turnary operator
    // condition ? true : false

    // dd($id);
    // if( $a == 10 ){
    //     return "number is 10";
    // }else{
    //     return "number is not 10";
    // }
});


Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
    return "This is post $postId and comment $commentId";
});

Route::get('/user/{name?}', function ($name = 'Ahmad') {
    return $name;
});


Route::get('/category/clothes', function(){
    return "this is cloth category";
});

Route::get('/category/animals', function(){
    return "this is animals category";
});

Route::view('login','Auth.login');

Route::post('login', function(){
    // return "this is login route";

    dd( request()->all() );

})->name('auth.login');