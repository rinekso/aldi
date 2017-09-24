<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(){
        $data = app('gallery')->getData();
        return view('page.gallery',['menuActive'=>'gallery','data'=>$data]);
    }
    public function input(Request $request){
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;
        unset($form['_token']);
        if (isset($request->path))
        {
            $extension = $request->file('path')->getClientOriginalExtension();
            if($extension == "jpg") {
                $photoProfileName               = date('d-m-Y_h-i-s');
                $photoProfileDestinationFolder  = public_path() . '/assets/images/gallery';
                $request
                    ->file('path')
                    ->move($photoProfileDestinationFolder, $photoProfileName . '.jpg');
                $form['path'] = $photoProfileName.'.jpg';
            }else{
                return redirect()->back()->withErrors(['file must jpg']);
            }
        }else{
            $form['path'] = '';
        }
        if(empty(@$form['id']))
            app('gallery')->input($form);
        else{
            $id = $form['id'];
            unset($form['id']);
            if($form['path'] == '')
                unset($form['path']);
            app('gallery')->update($form,$id);
        }
        return redirect('gallery');
    }
    public function delete($id){
        $data = app('gallery')->detail($id);
        $imagePath  = 'assets/images/gallery/'.$data->path;
        File::delete($imagePath);
        app('gallery')->delete($id);
        return redirect()->back();
    }
    public function getDetailJson($id){
        $data = app('gallery')->detail($id);
        return response()->json($data);
    }
}
