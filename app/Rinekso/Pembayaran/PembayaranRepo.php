<?php namespace App\Rinekso\Pembayaran;

use App\Rinekso\BaseRepo;

class PembayaranRepo extends BaseRepo
{
    public function __construct(Pembayaran $user)
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