<?php namespace App\Rinekso\Periode;

use App\Rinekso\BaseRepo;

class PeriodeRepo extends BaseRepo
{
    public function __construct(Periode $user)
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