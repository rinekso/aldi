<?php namespace App\Rinekso\Pembayaran;

use App\Rinekso\BaseRepo;
use Carbon\Carbon;

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
    public function updateCustom($input,$id)
    {
        $input['updated_at'] = Carbon::now();
        $this->model->where('id_pembayaran','=',$id)
            ->update($input);
        return true;
    }
    public function deleteCustom($id)
    {
        $res = $this->model->where('id_pembayaran','=',$id)
            ->delete();
        return true;
    }
    public function getDataSpec($id){
        $result = $this->model
            ->where('id_pembayaran','=',$id)
            ->with('kelas')
            ->with('jenjang')
            ->get();
        return $result;
    }
    public function getDataAllRelation(){
        $result = $this->model
            ->with('kelas')
            ->with('jenjang')
            ->get();
        return $result;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:39
 */