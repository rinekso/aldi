<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        return view('page.article',['menuActive'=>'article']);
    }
    public function input(Request $request){
        $form = $request->all();
        unset($form['test-editormd-markdown-doc']);
        dd($form);
    }
}
