<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinekso\JenisTransaksi\JenisTransaksiRepo;

class UserController extends Controller
{
	public function __construct(JenisTransaksiRepo $jenisTransaksiRepo){
        $this->jenis = $jenisTransaksiRepo;
	}
    public function index(){
        $jenisTr = $this->jenis->getData();
    	return view('pembayaran',['jenis'=>$jenisTr]);
    }
    public function menu($menu){
    	$nama = $this->jenis->getDataWhere('id_jenis_transaksi',$menu);
    	// dd($nama);
    	return view('menu',['nama'=>$nama[0]->nama_transaksi,'tagihan'=>0,'keterangan'=>""]);
    }
}
