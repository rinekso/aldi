<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('page.home',['menuActive' => 'home']);
    }
    public function login(){
        return view('page.login');
    }
    public function loginAction(Request $request){
        $form = $request->all();
        if(Auth::attempt(['email' => $form['email'], 'password' => $form['password']])){
            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['Password or username is wrong']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
