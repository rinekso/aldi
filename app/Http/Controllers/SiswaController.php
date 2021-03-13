<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinekso\Jenjang\JenjangRepo;
use App\Rinekso\Kelas\KelasRepo;
use App\Rinekso\Users\UserRepo;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use Carbon\Carbon;
use App\Exports\ContohExport;

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
    public function toIndex(){
        return view('index');
    }
    public function naik(){
        $siswa = $this->user->getSiswa();
        foreach ($siswa as $key => $s) {
            if($s->jenjang != null){
                $max = $s->jenjang->max_tingkat;
                $arr = [
                    "id_kelas" => $s->kelas->tingkat,
                    "id_jenjang" => $s->id_jenjang,
                    "naik" => Carbon::now()
                ];
                if($s->kelas->tingkat < $max)
                    $arr['id_kelas'] = $arr['id_kelas']+1;
                else{
                    $n = $s->jenjang->next_jenjang;
                    $arr['id_jenjang'] = $n;
                    if($n > 0)
                        $arr['id_kelas'] = 1;
                    else
                        $arr['id_kelas'] = 0;
                }
                $this->user->update($arr,$s->id);
            }
        }
    	return redirect()->back();
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
    public function delete($id){
        $this->user->delete($id);
    	return redirect()->back();
    }
    public function tambahAction(Request $request){
        $form = $request->all();
        // dd($form['nik']);
        unset($form['_token']);
        $form['id_user_role'] = 3;
        $form['password'] = Hash::make($form['password']);
        $f = $this->user->input($form);
        // dd($f);
        return redirect('/adm/siswa');
    }
    public function tambahExcel(Request $request){
        $file = $request->file('data');
        $extension = $file->getClientOriginalExtension();
        // dd($extension);
        if($extension == "xls" || $extension == "xlsx" || $extension == "csv"){
            $tujuan_upload = 'data_file';

            $name = "import_data_siswa_".rand(10000,99999).".".$file->getClientOriginalExtension();

            $result = $file->move($tujuan_upload,$name);
            if($result){
                if($this->readExcel("data_file/".$name))
                    return redirect('/adm/siswa');
            }
        }else{
            dd("file extensi salah");
        }

    }
    public function exportExample(){
        return Excel::download(new ContohExport, 'ContohStruktur.xlsx');
    }
    private function readExcel($fileName){
        return Excel::import(new SiswaImport, public_path($fileName));
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
