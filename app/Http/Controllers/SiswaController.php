<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinekso\Jenjang\JenjangRepo;
use App\Rinekso\Kelas\KelasRepo;
use App\Rinekso\Users\UserRepo;
use Illuminate\Support\Facades\Hash;
require_once 'assets\plugins\PhpExcelReader\Excel\reader.php';

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
        if($extension == "xls" || $extension == "xlsx"){
            $tujuan_upload = 'data_file';

            $name = "import_data_siswa_".rand(10000,99999).".".$file->getClientOriginalExtension();

            $result = $file->move($tujuan_upload,$name);
            if($result){
                readExcel("/data_file/".$name);

            }
        }else{
            dd("file extensi salah");
        }

    }
    private function readExcel($fileName){
        $data = new Spreadsheet_Excel_Reader();

        $data->setOutputEncoding('CP1251');
        $data->read($fileName);
        error_reporting(E_ALL ^ E_NOTICE);

        for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
            for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
                echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
            }
        }
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
