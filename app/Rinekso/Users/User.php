<?php namespace App\Rinekso\Users;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['nama','password','nik','rfid','saldo','id_jenjang','id_kelas','id_tahun_ajaran','id_user_role'];
    public $timestamps = true;

    public function userRole(){
    	return $this->hasOne('App\Rinekso\UserRole\UserRole','id_user_role','id_user_role');
    }
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