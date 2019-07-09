<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinekso\JenisTransaksi\JenisTransaksiRepo;
use App\Rinekso\Pembayaran\Pembayaran;
use App\Rinekso\Pembayaran\PembayaranRepo;
use App\Rinekso\Periode\PeriodeRepo;
use App\Rinekso\Transaksi\TransaksiRepo;
use App\Rinekso\Topup\TopupRepo;
use App\Rinekso\Users\UserRepo;
use PDF;
use Carbon\Carbon;

class UserController extends Controller
{
	public function __construct(JenisTransaksiRepo $jenisTransaksiRepo, PembayaranRepo $pembayaranRepo,PeriodeRepo $periodeRepo, TransaksiRepo $transaksiRepo,UserRepo $userRepo,TopupRepo $topupRepo){
		$this->jenis = $jenisTransaksiRepo;
		$this->pembayaran = $pembayaranRepo;
		$this->periode = $periodeRepo;
		$this->transaksi = $transaksiRepo;
		$this->user = $userRepo;
		$this->topup = $topupRepo;
	}
    public function index(){
        $jenisTr = $this->jenis->getData();
    	return view('pembayaran',['jenis'=>$jenisTr]);
    }
    public function menu($menu){
		$tagihan = 0;
		$periode=[];
		$keterangan = "";
		$idPeriode = 0;
		$jenis_transaksi = $this->jenis->getDataWhere('id_jenis_transaksi',$menu);
		$mutasi = [];
		$trm = $this->transaksi->getMutasi('id_user',\Auth::User()->id);
		$pembayaran = $this->pembayaran->getDataWhere3('id_jenis_transaksi',$jenis_transaksi[0]->id_jenis_transaksi,
			'id_kelas',\Auth::User()->id_kelas,'id_jenjang',\Auth::User()->id_jenjang);
		if(count($pembayaran) > 0){
			// if($menu == 1)
				$periode = $this->spp($pembayaran[0]->id_pembayaran);
			// else
			// 	$periode = $this->periode->getDataWhere('id_pembayaran',$pembayaran[0]->id_pembayaran);

			if(count($periode) > 0){
					foreach ($periode as $k => $p) {
						foreach ($p as $key => $pp) {
							$transaksi = $this->transaksi->getDataWhere3('id_periode',$pp->id_periode,'id_pembayaran',$pembayaran[0]->id_pembayaran,'id_user',\Auth::User()->id);
							if(count($transaksi) == 0){
								$periode[$k][$key]->paid = false;
								if(date('Y') >= $pp->tahun){
									if(date('m') >= date('m',strtotime($pp->nama_periode))){
										$tagihan = $pembayaran[0]->nominal;
										$keterangan = $pp->nama_periode." ".$pp->tahun;
										$idPeriode = $pp->id_periode;
									}
								}
							}else{
								$periode[$k][$key]->paid = true;
							}
						}
					}
			}
		}

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

		$topup = $this->topup->getDataWhere('id_user',\Auth::User()->id);
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
        // dd($periode);
    	return view('menu',['idJenisTr'=>$menu,'id_periode'=>$idPeriode,'nama'=>$jenis_transaksi[0]->nama_transaksi,'tagihan'=>$tagihan,'keterangan'=>$keterangan, 'periode'=>$periode,'mutasi'=>$mutasi]);
    }
    public function spp($id_pembayaran){
    	$d = $this->periode->getYear($id_pembayaran);
    	$result = [];
    	foreach ($d as $key => $dd) {
	    	$a = $this->periode->getDataWhere2('tahun',$dd->tahun,'id_pembayaran',$id_pembayaran);
	    	array_push($result, $a);
    	}
    	return $result;
    }
    public function pdf($input){
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($this->bukti($input));
		$output = $pdf->output();
		file_put_contents("bukti/".$input['kode'].".pdf",$output);
    }
    public function bukti($input){
		$output = "
		<h1>Laporan transaksi</h1>
		<table border=1 cellpadding=20>
			<tr>
				<th>Kode</th>
				<td>".$input['kode']."</td>
			</tr>
			<tr>
				<th>NIK</th>
				<td>".\Auth::User()->nik."</td>
			</tr>
			<tr>
				<th>Oleh</th>
				<td>".\Auth::User()->nama."</td>
			</tr>
			<tr>
				<th>Jenis Pembayaran</th>
				<td>".$input['jenis_transaksi']."</td>
			</tr>
			<tr>
				<th>Periode</th>
				<td>".$input['periode']."</td>
			</tr>
			<tr>
				<th>Nominal</th>
				<td>".$input['nominal']."</td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td>".Carbon::now()."</td>
			</tr>
		</table>";

    	return $output;
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
			$rand = rand(10000,99999);
			$input['kode'] = \Auth::User()->id_kelas."-".\Auth::User()->id_jenjang."-".$rand;
			$saldo = \Auth::User()->saldo;
			$this->user->update(['saldo'=>($saldo-$pembayaran[0]->nominal)],\Auth::User()->id);
			$this->transaksi->input($input);
			$input['jenis_transaksi'] = $jenis_transaksi[0]->nama_transaksi;
			$input['nominal'] = $pembayaran[0]->nominal;
			$periode = $this->periode->getDataWhere('id_periode',$request->id_periode)[0];
			$input['periode'] = $periode->nama_periode." ".$periode->tahun;
			$this->pdf($input);
			\Auth::User()->saldo = ($saldo-$pembayaran[0]->nominal);
			
			return redirect()->back()->withErrors(["text"=>"Berhasil dibayar"]);
		}
		return redirect()->back()->withErrors(["text"=>"terjadi kesalahan"]);
    }
    public function date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t1 - $t2;
    }
}
