<?php namespace App\Rinekso\Jenjang;

use App\Rinekso\BaseRepo;

class JenjangRepo extends BaseRepo
{
    public function __construct(Jenjang $user)
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