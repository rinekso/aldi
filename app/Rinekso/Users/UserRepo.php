<?php namespace App\Rinekso\Users;

use App\Rinekso\BaseRepo;

class UserRepo extends BaseRepo
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function getSiswa(){
        return $this->model
            ->select('*')
            ->with('jenjang')
            ->with('kelas')
            ->where('id_user_role','=','3')
            ->get();
    }
    public function getSiswaId($id){
        return $this->model
            ->select('*')
            ->where('id','=',$id)
            ->with('jenjang')
            ->with('kelas')
            ->get();
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:39
 */