<?php namespace App\Rinekso\Periode;

use App\Rinekso\BaseRepo;

class PeriodeRepo extends BaseRepo
{
    public function __construct(Periode $user)
    {
        $this->model = $user;
    }
    public function delete($id){
        $res = $this->model->where('id_periode','=',$id)
            ->delete();
        return true;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:39
 */