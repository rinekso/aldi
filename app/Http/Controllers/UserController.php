<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function account(){
        $data = app('user')->getData();
        return view('page.account',['menuActive' => 'account','data' => $data]);
    }
    public function input(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        if (empty(@$form['id'])) {
            $form['password'] = Hash::make($form['password']);
            app('user')->input($form);
        } else {
            $id = $form['id'];
            unset($form['id']);
            if($form['password'] == ''){
                unset($form['password']);
            }else{
                $form['password'] = Hash::make($form['password']);
            }
            app('user')->update($form, $id);
        }
        return redirect('account');
    }
    public function delete($id){
        $data = app('user')->detail($id);
        app('user')->delete($id);
        return redirect()->back();
    }
    public function getDetailJson($id){
        $data = app('user')->detail($id);
        return response()->json($data);
    }
}
