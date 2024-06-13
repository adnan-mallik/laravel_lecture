<?php

namespace App\Http\Controllers;


class Abc extends Controller
{
    //  access modifiers -> public, protected, private

    public $abc = "xyz";

    public static function index(){
        return 'Abc';
    }
    // public static function index(){
    //     return 'Abc';
    // }
}
