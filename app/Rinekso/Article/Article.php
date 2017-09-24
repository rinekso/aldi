<?php namespace App\Rinekso\Article;

use App\Rinekso\User\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model{
    protected $table = 'article';

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 22/09/17
 * Time: 7:57
 */