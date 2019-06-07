<?php namespace App\Rinekso\JenisTransaksi;

use App\Rinekso\BaseRepo;

class JenisTransaksiRepo extends BaseRepo
{
    public function __construct(JenisTransaksi $user)
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