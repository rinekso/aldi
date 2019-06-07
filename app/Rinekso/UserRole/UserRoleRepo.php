<?php namespace App\Rinekso\UserRole;

use App\Rinekso\BaseRepo;

class UserRoleRepo extends BaseRepo
{
    public function __construct(UserRole $user)
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