<?php namespace App\Rinekso\Kelas;

use App\Rinekso\BaseRepo;

class KelasRepo extends BaseRepo
{
    public function __construct(Kelas $user)
    {
        $this->model = $user;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:39
 */