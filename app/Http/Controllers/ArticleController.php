<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index(){
        $data = app('article')->getDAta();
        return view('page.article',['menuActive'=>'article','data' => $data]);
    }
    public function input(Request $request){
        $form = $request->all();
        $form['markdown'] = $form['test-editormd-markdown-doc'];
        $form['content'] = $form['test-editormd-html-code'];
        $form['user_id'] = Auth::user()->id;
        unset($form['test-editormd-html-code']);
        unset($form['test-editormd-markdown-doc']);
        unset($form['_token']);
        if (@$request->cover != '')
        {
            $extension = $request->file('cover')->getClientOriginalExtension();
            if($extension == "jpg") {
                $photoProfileName               = date('d-m-Y_h-i-s');
                $photoProfileDestinationFolder  = public_path() . '/assets/images/cover';
                $request
                    ->file('cover')
                    ->move($photoProfileDestinationFolder, $photoProfileName . '.jpg');
                $form['path'] = $photoProfileName.'.jpg';
            }else{
                return redirect()->back()->withErrors(['file must jpg']);
            }
        }else{
            $form['cover'] = '';
        }
        if(empty(@$form['id']))
            app('article')->input($form);
        else{
            $id = $form['id'];
            unset($form['id']);
            app('article')->update($form,$id);
        }
        return redirect('article');
    }
    public function delete($id){
        $data = app('article')->detail($id);
        $imagePath  = 'assets/images/cover/'.$data->path;
        File::delete($imagePath);
        app('article')->delete($id);
        return redirect()->back();
    }
    public function getDetailJson($id){
        $data = app('article')->detail($id);
        return response()->json($data);
    }
}
