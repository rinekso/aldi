<?php namespace App\Rinekso\Jenjang;

use App\Rinekso\BaseRepo;
use Carbon\Carbon;

class JenjangRepo extends BaseRepo
{
    public function __construct(Jenjang $user)
    {
        $this->model = $user;
    }
    public function updateCustom($input,$id)
    {
        $input['updated_at'] = Carbon::now();
        $this->model->where('id_jenjang','=',$id)
            ->update($input);
        return true;
    }
    public function deleteCustom($id)
    {
        $res = $this->model->where('id_jenjang','=',$id)
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