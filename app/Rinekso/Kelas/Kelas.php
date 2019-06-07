<?php namespace App\Rinekso\Kelas;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    public function users(){
        return $this->belongsToMany('App\Rinekso\User\User','id_kelas','id_kelas');
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:38
 */