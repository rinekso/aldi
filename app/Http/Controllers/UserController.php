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
    public function menu(){
    	return view('menu');
    }
}
