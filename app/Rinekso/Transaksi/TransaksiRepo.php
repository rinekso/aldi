<?php namespace App\Rinekso\Transaksi;

use App\Rinekso\BaseRepo;

class TransaksiRepo extends BaseRepo
{
    public function __construct(Transaksi $user)
    {
        $this->model = $user;
    }
    public function getMutasi($kolom,$value){
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->with('pembayaran')
            ->get();
        return $proses;
    }
    public function getDataReport($kolom,$value,$month,$id_jenis){
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->whereMonth('created_at',$month)
            ->whereHas('pembayaran',function($query) use ($id_jenis){
                $query->where('id_pembayaran','=',$id_jenis);
            })
            ->with('pembayaran.jenisTransaksi')
            ->with('user')
            ->get();
        return $proses;
    }
    public function getDataAllRelation(){
        $result = $this->model
            ->with('kelas')
            ->with('jenjang')
            ->get();
        return $result;
    }
    public function getDataReportTahunan($kolom,$value,$id_jenis){
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->whereHas('pembayaran',function($query) use ($id_jenis){
                $query->where('id_pembayaran','=',$id_jenis);
            })
            ->with('pembayaran.jenisTransaksi')
            ->with('user')
            ->get();
        return $proses;
    }
    public function getDataReportSemester($kolom,$value,$startMonth,$endMonth,$id_jenis){
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->whereMonth('created_at','>=',$startMonth)
            ->whereMonth('created_at','<=',$endMonth)
            ->whereHas('pembayaran',function($query) use ($id_jenis){
                $query->where('id_pembayaran','=',$id_jenis);
            })
            ->with('pembayaran')
            ->with('user')
            ->get();
        return $proses;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:39
 */