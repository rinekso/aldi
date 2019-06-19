<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinekso\Jenjang\JenjangRepo;
use App\Rinekso\Kelas\KelasRepo;
use App\Rinekso\Users\UserRepo;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function __construct(JenjangRepo $jenjang, KelasRepo $kelasRepo, UserRepo $userRepo)
    {
        $this->jenjang = $jenjang;
        $this->kelas = $kelasRepo;
        $this->user = $userRepo;
    }
    public function index(){
        $data = $this->user->getSiswa();
        // dd($data);
    	return view('admin.siswa',['siswa'=>$data]);
    }
    public function tambah(){
        $jenjang = $this->jenjang->getData();
        $kelas = $this->kelas->getData();
    	return view('admin.siswaTambah',['jenjang'=>$jenjang,'kelas'=>$kelas]);
    }
    public function edit($id){
        $siswa = $this->user->getSiswaId($id);
        $jenjang = $this->jenjang->getData();
        $kelas = $this->kelas->getData();
    	return view('admin.siswaEdit',['jenjang'=>$jenjang,'kelas'=>$kelas,'siswa'=>$siswa]);
    }
    public function tambahAction(Request $request){
        $form = $request->all();
        unset($form['_token']);
        $form['id_user_role'] = 2;
        $form['password'] = Hash::make($form['password']);
        $this->user->input($form);
        return redirect('/adm/siswa');        
    }
    public function editAction(Request $request){
        $form = $request->all();
        $id = $form['id'];
        unset($form['_token']);
        unset($form['id']);
        
        if($form['password'] == "")
            unset($form['password']);
        else
            $form['password'] = Hash::make($form['password']);
        
        $this->user->update($form,$id);
        return redirect('/adm/siswa');
    }
}
