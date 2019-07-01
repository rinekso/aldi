<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rinekso\Users\UserRepo;
use App\Rinekso\JenisTransaksi\JenisTransaksiRepo;
use App\Rinekso\Kelas\KelasRepo;
use App\Rinekso\Periode\PeriodeRepo;
use App\Rinekso\Pembayaran\PembayaranRepo;
use App\Rinekso\Jenjang\JenjangRepo;

class AdminController extends Controller
{
    public function __construct(UserRepo $user,JenisTransaksiRepo $jenisTransaksiRepo, KelasRepo $kelas, PeriodeRepo $periodeRepo,PembayaranRepo $pembayaranRepo, JenjangRepo $jenjangRepo)
    {
        $this->user = $user;
        $this->jenisTransaksi = $jenisTransaksiRepo;
        $this->kelas = $kelas;
        $this->periode = $periodeRepo;
        $this->pembayaran = $pembayaranRepo;
        $this->jenjang = $jenjangRepo;
    }

    public function loginUser(Request $request){
    	$form=$request->all();
    	$rfid=$form['rfid'];
    	$password=$form['pin'];
        if(Auth::attempt(['rfid' => $rfid, 'password' => $password])){
        	Auth::login(Auth::user(), true);
            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['Password or username is incorrect']);
        }

    }
    public function logCode($code){
    	$data = \DB::table('logintemp')->where('code','=',$code)->get();
    	$rfid=$data[0]->rfid;
    	$password=$data[0]->password;
        if(Auth::attempt(['rfid' => $rfid, 'password' => $password])){
        	Auth::login(Auth::user(), true);
        	\DB::table('logintemp')->where('code','=',$code)->delete();
            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['Password or username is incorrect']);
        }
    }
    public function loginUserApi(Request $request){
    	$form=$request->all();
    	$rfid=$form['rfid'];
    	$password=$form['pin'];
    	$code = rand(10000,99999);

        if(Auth::attempt(['rfid' => $rfid, 'password' => $password])){
        	\DB::table('logintemp')->insert([
        		'rfid' => $rfid,
        		'password' => $password,
        		'code' => $code
        	]);
        	Auth::login(Auth::user(), true);
            return ['status'=>true,'redirect'=>'http://localhost:8000/log/code/'.$code];
        }else{
            return ['status'=>false,'message'=>'pin salah'];
        }

    }
    public function index(){
    	return view('admin.index');
    }
    public function logout(){
    	Auth::logout();
    	return redirect('/adm');
    }
    public function logoutUser(){
    	Auth::logout();
    	return redirect('/');
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
        $siswa = $this->user->getData();
        $jenis_transaksi = $this->jenisTransaksi->getData();
        $kelas = $this->kelas->getData();
        $periode = $this->periode->getData();
        $pembayaran = $this->pembayaran->getData();
        $jenjang = $this->jenjang->GetData();

        $daftarBiaya = [];
        // dd($kelas[2]);
        for($i=0;$i<count($kelas);$i++){
            $daftarBiaya[$i] = [];
            for($j=0;$j<count($jenjang);$j++)
            {
                $daftarBiaya[$i][$j] = [];
                for($k=0;$k<count($jenis_transaksi);$k++){
                    $dat = $this->pembayaran->getDataWhere3('id_kelas',$kelas[$i]->id_kelas,'id_jenjang',$jenjang[$j]->id_jenjang,'id_jenis_transaksi',$jenis_transaksi[$k]->id_jenis_transaksi);
                    $nominal = 0;
                    if(count($dat) > 0)
                        $nominal = $dat[0]->nominal;
                    $daftarBiaya[$i][$j][$k] = $nominal;
                }
            }
        }

        // dd($daftarBiaya);
    	return view('admin.topup',['siswa'=>$siswa,'jenis_transaksi'=>$jenis_transaksi,'kelas' => $kelas,'periode' => $periode,'pembayaran' => $pembayaran,'jenjang' => $jenjang,'daftar_biaya'=>$daftarBiaya]);
    }
    public function periode(){
        $siswa = $this->user->getData();
        $jenis_transaksi = $this->jenisTransaksi->getData();
        $kelas = $this->kelas->getData();
        $periode = $this->periode->getData();
        $pembayaran = $this->pembayaran->getData();
        $jenjang = $this->jenjang->GetData();

        $daftarBiaya = [];
        // dd($kelas[2]);
        for($i=0;$i<count($kelas);$i++){
            $daftarBiaya[$i] = [];
            for($j=0;$j<count($jenjang);$j++)
            {
                $daftarBiaya[$i][$j] = [];
                for($k=0;$k<count($jenis_transaksi);$k++){
                    $dat = $this->pembayaran->getDataWhere3('id_kelas',$kelas[$i]->id_kelas,'id_jenjang',$jenjang[$j]->id_jenjang,'id_jenis_transaksi',$jenis_transaksi[$k]->id_jenis_transaksi);
                    $nominal = 0;
                    $id = 0;
                    if(count($dat) > 0){
                        $nominal = $dat[0]->nominal;
                        $id = $dat[0]->id_pembayaran;
                    }
                    $daftarBiaya[$i][$j][$k]['nominal'] = $nominal;
                    $daftarBiaya[$i][$j][$k]['id'] = $id;
                }
            }
        }
        // dd($daftarBiaya);
    	return view('admin.periode',['siswa'=>$siswa,'jenis_transaksi'=>$jenis_transaksi,'kelas' => $kelas,'periode' => $periode,'pembayaran' => $pembayaran,'jenjang' => $jenjang,'daftar_biaya'=>$daftarBiaya]);
    }
    public function detailPeriode($id){
        $jenis_transaksi = $this->jenisTransaksi->getData();
        $kelas = $this->kelas->getData();
        $periode = $this->periode->getDataWhere('id_pembayaran',$id);
        $jenjang = $this->jenjang->getData();
        $pembayaran = $this->pembayaran->getDataSpec($id);
    	return view('admin.detailPeriode',['periode'=>$periode,'kelas'=>$kelas,'jenis_transaksi'=> $jenis_transaksi, 'jenjang'=>$jenjang,'pembayaran'=>$pembayaran]);
    }
    public function periodeDelete($id){
        $periode = $this->periode->delete($id);
        return redirect()->back();
    }
    public function periodeTambah(Request $request){
    	$form = $request->all();
    	$type = $form['type'];
    	$tahun = $form['tahun'];
    	$nama = $form['nama'];
    	$id_pembayaran = $form['id_pembayaran'];
		$input=[];
		$input['tahun'] = $tahun;
		$input['id_pembayaran'] = $id_pembayaran;
    	if($type == 1){
    		for ($i=1; $i < 13; $i++) { 
				$monthNum  = $i;
				$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
    			$input['nama_periode'] = $monthName;
	    		$this->periode->input($input);
    		}
    	}elseif($type == 0){
			$input['nama_periode'] = $nama;
    		$this->periode->input($input);
    	}
    	return redirect()->back();
    }
    public function topupProcess(Request $request){
        $form = $request->all();
        $nominal = $form['nominal'];
        $rfid = $form['rfid'];
        $currentSaldo = $this->user->getDataWhere('rfid',$rfid);
        if(count($currentSaldo) > 0){
		    $this->user->update(['saldo'=>$currentSaldo[0]->saldo+$nominal],$currentSaldo[0]->id);
		    return redirect('/adm/topup');
        }else{
        	return "id salah";
        }
        // dd($currentSaldo);
    }
    public function biayaGanti(Request $request){
        $form = $request->all();
        $id_jenis = $form['id_jenis_transaksi'];
        $id_kelas = $form['id_kelas'];
        $id_jenjang = $form['id_jenjang'];
        $nominal = $form['nominal'];
        $this->pembayaran->gantiBiaya($id_jenis,$id_kelas,$id_jenjang,$nominal);
        return redirect('/adm/periode');
    }
}
