<?php namespace App\Rinekso\Transaksi;

use App\Rinekso\BaseRepo;

class TransaksiRepo extends BaseRepo
{
    public function __construct(Transaksi $user)
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