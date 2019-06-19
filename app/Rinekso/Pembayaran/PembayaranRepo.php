<?php namespace App\Rinekso\Pembayaran;

use App\Rinekso\BaseRepo;

class PembayaranRepo extends BaseRepo
{
    public function __construct(Pembayaran $user)
    {
        $this->model = $user;
    }
    public function gantiBiaya($id_jenis,$id_kelas,$id_jenjang,$nominal){
        $proses = $this->model
            ->where('id_jenis_transaksi','=',$id_jenis)
            ->where('id_kelas','=',$id_kelas)
            ->where('id_jenjang','=',$id_jenjang)
            ->get();
        if(count($proses)>0){
            $this->model
                ->where('id_jenis_transaksi','=',$id_jenis)
                ->where('id_kelas','=',$id_kelas)
                ->where('id_jenjang','=',$id_jenjang)
                ->update(['nominal'=>$nominal]);
        }else{
            $this->model
                ->insert([
                    'id_kelas' => $id_kelas,
                    'id_jenjang' => $id_jenjang,
                    'id_jenis_transaksi' => $id_jenis,
                    'nominal' => $nominal
                ]);
        }
        return $proses;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:39
 */