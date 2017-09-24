<?php namespace App\Rinekso\Gallery;
use App\Rinekso\User\User;
use Illuminate\Database\Eloquent\Model;

class  Gallery  extends Model {
    protected $table = 'gallery';
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 22/09/17
 * Time: 14:11
 */