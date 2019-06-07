<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
    	return view('admin.index');
    }
    public function loginProcess(Request $request){
        $form = $request->all();
        // dd(Auth::attempt(['nama' => $form['username'], 'password' => $form['password']]));
        if(Auth::attempt(['nama' => $form['username'], 'password' => $form['password']])){
        	Auth::login(Auth::user(), true);
            return redirect('/adm');
        }else{
            return redirect()->back()->withErrors(['Password or username is incorrect']);
        }
    }
    public function history(){
    	return view('admin.history');
    }
    public function siswa(){
    	return view('admin.siswa');
    }
    public function topup(){
    	return view('admin.topup');
    }
}
