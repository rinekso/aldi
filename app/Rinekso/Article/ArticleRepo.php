<?php namespace App\Rinekso\Article;

use App\Rinekso\BaseRepo;

class ArticleRepo extends BaseRepo{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }
    public function searchAll($input){
        return $this->model->select('*')
            ->where('title','like','%'.$input.'%')
            ->orWhere('summary','like','%'.$input.'%')
            ->orWhere('markdown','like','%'.$input.'%')
            ->get();
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 22/09/17
 * Time: 8:02
 */