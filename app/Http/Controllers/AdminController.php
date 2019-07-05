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
use App\Rinekso\Transaksi\TransaksiRepo;
use App\Rinekso\Topup\TopupRepo;

class AdminController extends Controller
{
    public function __construct(UserRepo $user,JenisTransaksiRepo $jenisTransaksiRepo, KelasRepo $kelas, PeriodeRepo $periodeRepo,PembayaranRepo $pembayaranRepo, JenjangRepo $jenjangRepo, TransaksiRepo $transaksiRepo, TopupRepo $topupRepo)
    {
        $this->user = $user;
        $this->jenisTransaksi = $jenisTransaksiRepo;
        $this->kelas = $kelas;
        $this->periode = $periodeRepo;
        $this->pembayaran = $pembayaranRepo;
        $this->jenjang = $jenjangRepo;
        $this->transaksi = $transaksiRepo;
        $this->topup = $topupRepo;
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
            $rand = rand(10000,99999);
            $input = [
                'id_user'=>$currentSaldo[0]->id,
                'nominal' => $nominal,
                'kode' => $currentSaldo[0]->id_kelas."-".$currentSaldo[0]->id_jenjang."-".$rand
            ];
            $this->topup->input($input);
		    $this->user->update(['saldo'=>$currentSaldo[0]->saldo+$nominal],$currentSaldo[0]->id);
		    return redirect()->back()->withErrors(["text"=>"Berhasil topup"]);
        }else{
		    return redirect()->back()->withErrors(["text"=>"id salah"]);
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
    public function laporanPembayaran(Request $request){
        $jenis_transaksi = $this->jenisTransaksi->getData();
        $kelas = $this->kelas->getData();
        $periode = $this->periode->getData();
        $pembayaran = $this->pembayaran->getData();
        $jenjang = $this->jenjang->GetData();

        $form = $request->all();
        $id_jenis_transaksi = $form['id_jenis_transaksi'];
        $id_kelas = $form['id_kelas'];
        $id_jenjang = $form['id_jenjang'];
        $rentang = $form['rentang'];

        $result = [];
        $laporan = [];
        $laporan['name'] = "pembayaran";
        $laporan['jenis']=$this->jenisTransaksi->getDataWhere('id_jenis_transaksi',$id_jenis_transaksi);
        $laporan['kelas']=$this->kelas->getDataWhere('id_kelas',$id_kelas);
        $laporan['jenjang']=$this->jenjang->getDataWhere('id_jenjang',$id_jenjang);
        $userTr = $this->user->getDataWhere2('id_kelas',$id_kelas,'id_jenjang',$id_jenjang);
        foreach ($userTr as $key => $u) {
            switch ($rentang) {
                case 1:
                    for ($i=0; $i < 12; $i++) { 
                        $result[$i] = $this->transaksi->getDataReport('id_user',$u->id,$i+1,$id_jenis_transaksi);
                        $result[$i]->name = 'bulan '.($i+1);
                    }
                    break;
                case 2:
                    $result[0] = $this->transaksi->getDataReportSemester('id_user',$u->id,1,6,$id_jenis_transaksi);
                    $result[0]->name = 'bulan 1-6';
                    $result[1] = $this->transaksi->getDataReportSemester('id_user',$u->id,7,12,$id_jenis_transaksi);
                    $result[1]->name = 'bulan 7-12';
                    break;
                
                case 3:
                    $result[0] = $this->transaksi->getDataWhere('id_user',$u->id);
                    $result[0]->name = 'tahunan';
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        $data = ['jenis_transaksi'=>$jenis_transaksi,'kelas' => $kelas,'periode' => $periode,'pembayaran' => $pembayaran,'jenjang' => $jenjang,'result'=>$result,'laporan'=>$laporan];
        
        // dd($result);
        return view('admin.laporan',$data);
    }
    public function laporanTopup(Request $request){
        $jenis_transaksi = $this->jenisTransaksi->getData();
        $kelas = $this->kelas->getData();
        $periode = $this->periode->getData();
        $pembayaran = $this->pembayaran->getData();
        $jenjang = $this->jenjang->GetData();

        $form = $request->all();
        $id_kelas = $form['id_kelas'];
        $id_jenjang = $form['id_jenjang'];
        $rentang = $form['rentang'];

        $result = [];
        $laporan = [];
        $laporan['name'] = "topup";
        // $laporan['jenis']=$this->jenisTransaksi->getDataWhere('id_jenis_transaksi',$id_jenis_transaksi);
        // $laporan['kelas']=$this->kelas->getDataWhere('id_kelas',$id_kelas);
        // $laporan['jenjang']=$this->jenjang->getDataWhere('id_jenjang',$id_jenjang);
        if($id_kelas == 0 && $id_jenjang != 0)
            $userTr = $this->user->getDataWhere('id_jenjang',$id_jenjang);
        elseif($id_kelas != 0 && $id_jenjang == 0)
            $userTr = $this->user->getDataWhere('id_kelas',$id_kelas);
        elseif($id_kelas == 0 && $id_jenjang == 0)
            $userTr = $this->user->getData();
        else
            $userTr = $this->user->getDataWhere('id_jenjang',$id_jenjang,'id_kelas',$id_kelas);

        foreach ($userTr as $key => $u) {
            switch ($rentang) {
                case 1:
                    for ($i=0; $i < 12; $i++) { 
                        $result[$i] = $this->topup->getDataReport('id_user',$u->id,$i+1);
                        $result[$i]->name = 'bulan '.($i+1);
                    }
                    break;
                case 2:
                    $result[0] = $this->topup->getDataReportSemester('id_user',$u->id,1,6);
                    $result[0]->name = 'bulan 1-6';
                    $result[1] = $this->topup->getDataReportSemester('id_user',$u->id,7,12);
                    $result[1]->name = 'bulan 7-12';
                    break;
                
                case 3:
                    $result[0] = $this->topup->getDataWhere('id_user',$u->id);
                    $result[0]->name = 'tahunan';
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        $data = ['jenis_transaksi'=>$jenis_transaksi,'kelas' => $kelas,'periode' => $periode,'pembayaran' => $pembayaran,'jenjang' => $jenjang,'result'=>$result,'laporan'=>$laporan];
        
        // dd($result);
        return view('admin.laporan',$data);
    }
    public function mutasi($id){
        $mutasi = [];
        $user = $this->user->getSiswaId($id);
        // dd($user);
		$trm = $this->transaksi->getMutasi('id_user',$id);
        $k=0;
		foreach($trm as $key => $t){
			$mutasi[$key]['kode'] = $t->kode;
			$mutasi[$key]['id_user'] = $t->id_user;
			$mutasi[$key]['nominal'] = $t->pembayaran->nominal;
			$mutasi[$key]['status'] = 'keluar';
			$mutasi[$key]['keterangan'] = $t->pembayaran->jenisTransaksi->nama_transaksi;
			$mutasi[$key]['date'] = $t->created_at;
            $k++;
		}

		$topup = $this->topup->getDataWhere('id_user',$id);
		$i = $k+1;
		// dd(count($trm));
		foreach($topup as $k => $t){
			$mutasi[$k+$i]['kode'] = $t->kode;
			$mutasi[$k+$i]['id_user'] = $t->id_user;
			$mutasi[$k+$i]['nominal'] = $t->nominal;
			$mutasi[$k+$i]['status'] = 'masuk';
			$mutasi[$k+$i]['keterangan'] = 'topup';
			$mutasi[$k+$i]['date'] = $t->created_at;

			$i++;
		}
        usort($mutasi, array($this, "date_compare"));
        return view('admin.siswaMutasi',['mutasi'=>$mutasi,'user'=>$user]);
    }
    public function date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t1 - $t2;
    }
    public function laporan(){
        $jenis_transaksi = $this->jenisTransaksi->getData();
        $kelas = $this->kelas->getData();
        $periode = $this->periode->getData();
        $pembayaran = $this->pembayaran->getData();
        $jenjang = $this->jenjang->GetData();
    	return view('admin.laporan',['jenis_transaksi'=>$jenis_transaksi,'kelas' => $kelas,'periode' => $periode,'pembayaran' => $pembayaran,'jenjang' => $jenjang]);
    }
}
