<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinekso\JenisTransaksi\JenisTransaksiRepo;
use App\Rinekso\Pembayaran\Pembayaran;
use App\Rinekso\Pembayaran\PembayaranRepo;
use App\Rinekso\Periode\PeriodeRepo;
use App\Rinekso\Transaksi\TransaksiRepo;
use App\Rinekso\Users\UserRepo;

class UserController extends Controller
{
	public function __construct(JenisTransaksiRepo $jenisTransaksiRepo, PembayaranRepo $pembayaranRepo,PeriodeRepo $periodeRepo, TransaksiRepo $transaksiRepo,UserRepo $userRepo){
		$this->jenis = $jenisTransaksiRepo;
		$this->pembayaran = $pembayaranRepo;
		$this->periode = $periodeRepo;
		$this->transaksi = $transaksiRepo;
		$this->user = $userRepo;
	}
    public function index(){
        $jenisTr = $this->jenis->getData();
    	return view('pembayaran',['jenis'=>$jenisTr]);
    }
    public function menu($menu){
		$tagihan = 0;
		$keterangan = "";
		$idPeriode = 0;
		$jenis_transaksi = $this->jenis->getDataWhere('id_jenis_transaksi',$menu);
		$pembayaran = $this->pembayaran->getDataWhere3('id_jenis_transaksi',$jenis_transaksi[0]->id_jenis_transaksi,
			'id_kelas',\Auth::User()->id_kelas,'id_jenjang',\Auth::User()->id_jenjang);
		if(count($pembayaran) > 0){
			$periode = $this->periode->getDataWhere('id_pembayaran',$pembayaran[0]->id_pembayaran);
			if(count($periode) > 0){
				foreach($periode as $p){
					$transaksi = $this->transaksi->getDataWhere3('id_periode',$p->id_periode,'id_pembayaran',$pembayaran[0]->id_pembayaran,'id_user',\Auth::User()->id);
					if(count($transaksi) == 0){
						if($menu == 1){
							if(date('m') >= date('m',strtotime($p->nama_periode))){
								$tagihan = $pembayaran[0]->nominal;
								$keterangan = $p->nama_periode;
								$idPeriode = $p->id_periode;
							}
						}else{
							$tagihan = $pembayaran[0]->nominal;
							$keterangan = $p->nama_periode;
							$idPeriode = $p->id_periode;
						}
					}
				}
			}
		}
    	return view('menu',['idJenisTr'=>$menu,'id_periode'=>$idPeriode,'nama'=>$jenis_transaksi[0]->nama_transaksi,'tagihan'=>$tagihan,'keterangan'=>$keterangan]);
    }
    public function bayar($menu, Request $request){
		$tagihan = 0;
		$keterangan = "";
		$jenis_transaksi = $this->jenis->getDataWhere('id_jenis_transaksi',$menu);
		$pembayaran = $this->pembayaran->getDataWhere3('id_jenis_transaksi',$jenis_transaksi[0]->id_jenis_transaksi,
			'id_kelas',\Auth::User()->id_kelas,'id_jenjang',\Auth::User()->id_jenjang);
		if(count($pembayaran) > 0){
			if($pembayaran[0]->nominal > \Auth::User()->saldo){
				return redirect()->back()->withErrors(["text"=>"saldo tidak cukup"]);
			}
			$input=[];
			$input['id_pembayaran'] = $pembayaran[0]->id_pembayaran;
			$input['id_periode'] = $request->id_periode;
			$input['id_user'] = \Auth::User()->id;
			$saldo = \Auth::User()->saldo;
			$this->user->update(['saldo'=>($saldo-$pembayaran[0]->nominal)],\Auth::User()->id);
			$this->transaksi->input($input);
			\Auth::User()->saldo = ($saldo-$pembayaran[0]->nominal);
			return redirect()->back();
		}
		return redirect()->back()->withErrors(["text"=>"terjadi kesalahan"]);
    }
}
