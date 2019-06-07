<?php namespace App\Rinekso\JenisPeriode;

use App\Rinekso\BaseRepo;

class JenisPeriodeRepo extends BaseRepo
{
    public function __construct(JenisPeriode $user)
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