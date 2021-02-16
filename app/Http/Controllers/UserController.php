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
use DateTime;

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
        $jenisTr = $this->pembayaran->getDataByUser(\Auth::User()->id_kelas,\Auth::User()->id_jenjang);
    	return view('pembayaran',['jenis'=>$jenisTr]);
    }
    public function menu($menu){
		$tagihan = 0;
		$periode=[];
		$keterangan = "";
		$idPeriode = 0;
		$pembayaran = $this->pembayaran->getDataWhere('id_pembayaran',$menu);
		$mutasi = [];
		$trm = $this->transaksi->getMutasi('id_user',\Auth::User()->id);
		$pembayaranDate = date('Y-m-d',strtotime($pembayaran[0]->tahun."-".$pembayaran[0]->bulan_start."-".$pembayaran[0]->tanggal_start));
		if(date('Y-m-d') >= $pembayaranDate){
			$diff = abs(strtotime(date('Y')) - strtotime($pembayaran[0]->tahun));
			
			$diffYears = floor($diff / (365*60*60*24));
			
			$transaksi = $this->transaksi->getDataWhere2('id_pembayaran',$pembayaran[0]->id_pembayaran,'id_user',\Auth::User()->id);
			$jumlahTr = count($transaksi);

			if($pembayaran[0]->periode > 0)
				for ($i=0; $i <= $diffYears; $i++) {
					$periode["tahun-".($pembayaran[0]->tahun+$i)] = [];
					
					$j=1;
					if($i==0) $j=$pembayaran[0]->bulan_start;
					
					for ($j; $j <= 12; $j+=$pembayaran[0]->periode) { 
						$arrTemp = [];
						$dateObj   	= DateTime::createFromFormat('!m', $j);
						$monthName 	= $dateObj->format('F');
						$arrTemp["month"] = $monthName;
						if($jumlahTr == 0){

							$arrTemp["paid"] = false;
							
							if($tagihan == 0 && date('m') >= $j){
								$tagihan 	= $pembayaran[0]->nominal;
								$keterangan	= $monthName." ".($pembayaran[0]->tahun+$i);
							}
							
						}else{
							$arrTemp["paid"] = true;
							$arrTemp["kode"] = $transaksi[$jumlahTr-1]->kode;
							$jumlahTr--;
						}
						$periode["tahun-".($pembayaran[0]->tahun+$i)][] = $arrTemp;
					}
				}
		}
        $k = 0;
		foreach($trm as $key => $t){
			$mutasi[$key]['kode'] = $t->kode;
			$mutasi[$key]['id_user'] = $t->id_user;
			$mutasi[$key]['nominal'] = $t->pembayaran->nominal;
			$mutasi[$key]['status'] = 'keluar';
			$mutasi[$key]['keterangan'] = $t->pembayaran->nama;
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
        // dd($periode["tahun-".$pembayaran[0]->tahun]);
    	return view('menu',['idJenisTr'=>$menu,'pembayaran'=>$pembayaran[0],'tagihan'=>$tagihan,'keterangan'=>$keterangan, 'periode'=>$periode,'mutasi'=>$mutasi]);
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
		return $pdf->download("bukti/".$input['kode'].".pdf");
    }
    public function cetakPdf(Request $request){
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($this->cetakBukti($request['kode'],$request['periode']));
		$output = $pdf->output();
		return $pdf->download("bukti/".$request['kode'].".pdf");
    }
	public function cetakBukti($kode,$periode){
		$data = $this->transaksi->getDataKode($kode);
		$output = "
		<h1>Laporan transaksi</h1>
		<table border=0 cellpadding=10 align=left>
			<tr>
				<th align=left>Kode</th>
				<td>".$kode."</td>
			</tr>
			<tr>
				<th align=left>NIK</th>
				<td>".\Auth::User()->nik."</td>
			</tr>
			<tr>
				<th align=left>Oleh</th>
				<td>".\Auth::User()->nama."</td>
			</tr>
			<tr>
				<th align=left>Jenis Pembayaran</th>
				<td>".$data[0]->pembayaran->nama."</td>
			</tr>
			<tr>
				<th align=left>Periode</th>
				<td>".$periode."</td>
			</tr>
			<tr>
				<th align=left>Nominal</th>
				<td>".$data[0]->pembayaran->nominal."</td>
			</tr>
			<tr>
				<th align=left>Tanggal</th>
				<td>".$data[0]->created_at."</td>
			</tr>
		</table>";

    	return $output;
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
				<td>".$input['pembayaran']."</td>
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
		$pembayaran = $this->pembayaran->getDataWhere('id_pembayaran',$menu);

		if($pembayaran[0]->nominal > \Auth::User()->saldo){
			return redirect()->back()->withErrors(["text"=>"saldo tidak cukup"]);
		}
		$input=[];
		$input['id_pembayaran'] = $pembayaran[0]->id_pembayaran;
		$input['id_user'] = \Auth::User()->id;
		$rand = rand(10000,99999);
		$input['kode'] = \Auth::User()->id_kelas."-".\Auth::User()->id_jenjang."-".$rand;
		$saldo = \Auth::User()->saldo;
		\Auth::User()->saldo = ($saldo-$pembayaran[0]->nominal);
		$this->user->update(['saldo'=>($saldo-$pembayaran[0]->nominal)],\Auth::User()->id);
		$this->transaksi->input($input);
		$input['pembayaran'] = $pembayaran[0]->nama;
		$input['nominal'] = $pembayaran[0]->nominal;
		$input['periode'] = $request["periode"];
		$this->pdf($input);
		
		return redirect()->back()->withErrors(["text"=>"Berhasil dibayar"]);
    }
    public function date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t1 - $t2;
    }
}
