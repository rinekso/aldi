<?php namespace App\Rinekso\Pembayaran;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    public $timestamps = true;

    public function jenjang(){
    	return $this->hasOne('App\Rinekso\Jenjang\Jenjang','id_jenjang','id_jenjang');
    }
    public function kelas(){
    	return $this->hasOne('App\Rinekso\Kelas\Kelas','id_kelas','id_kelas');
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 14:38
 */