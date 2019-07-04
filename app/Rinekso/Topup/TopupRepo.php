<?php namespace App\Rinekso\Topup;

use App\Rinekso\BaseRepo;

class TopupRepo extends BaseRepo
{
    public function __construct(Topup $user)
    {
        $this->model = $user;
    }
    public function delete($id){
        $res = $this->model->where('id','=',$id)
            ->delete();
        return true;
    }
    public function getDataReport($kolom,$value,$month){
        $proses = $this->model
            // ->where($kolom,'=',$value)
            ->whereMonth('created_at','=',$month)
            ->with('user')
            ->get();
        return $proses;
    }
    public function getDataReportSemester($kolom,$value,$startMonth,$endMonth){
        $proses = $this->model
            // ->where($kolom,'=',$value)
            ->whereMonth('created_at','>=',$startMonth)
            ->whereMonth('created_at','<=',$endMonth)
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