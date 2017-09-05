<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('page.home',['menuActive' => 'home']);
    }
    public function login(){
        return view('page.login');
    }
}
