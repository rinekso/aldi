<?php namespace App\Rinekso\Transaksi;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = true;
    public function pembayaran(){
        return $this->hasOne('App\Rinekso\Pembayaran\Pembayaran','id_pembayaran','id_pembayaran');
    }
    public function periode(){
        return $this->hasOne('App\Rinekso\Periode\Periode','id_periode','id_periode');
    }
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