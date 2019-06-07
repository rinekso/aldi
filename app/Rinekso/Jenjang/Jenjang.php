<?php namespace App\Rinekso\Jenjang;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $table = 'jenjang';

    public function users(){
        return $this->belongsToMany('App\Rinekso\User\User','id_jenjang','id_jenjang');
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:38
 */