<?php namespace App\Rinekso\Topup;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = 'topup';
    public function user(){
        return $this->hasOne('App\Rinekso\Users\User','id','id_user');
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:38
 */