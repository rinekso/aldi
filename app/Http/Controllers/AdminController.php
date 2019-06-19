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
    public function topupProcess(Request $request){
        $form = $request->all();
        $nominal = $form['nominal'];
        $id = $form['id'];
        $currentSaldo = $this->user->detail($id);
        $this->user->update(['saldo'=>$currentSaldo->saldo+$nominal],$id);
        return redirect('/adm/topup');
    }
    public function biayaGanti(Request $request){
        $form = $request->all();
        $id_jenis = $form['id_jenis_transaksi'];
        $id_kelas = $form['id_kelas'];
        $id_jenjang = $form['id_jenjang'];
        $nominal = $form['nominal'];
        $this->pembayaran->gantiBiaya($id_jenis,$id_kelas,$id_jenjang,$nominal);
        return redirect('/adm/topup');
    }
}
