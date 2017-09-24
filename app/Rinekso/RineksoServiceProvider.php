<?php namespace App\Rinekso;

use App\Rinekso\Article\Article;
use App\Rinekso\Article\ArticleRepo;
use App\Rinekso\Gallery\Gallery;
use App\Rinekso\Gallery\GalleryRepo;
use App\Rinekso\User\User;
use App\Rinekso\User\UserRepo;
use Illuminate\Support\ServiceProvider;

class RineksoServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->app->bind('user',function(){
            return new UserRepo(
                new User()
            );
        });
        $this->app->bind('article',function(){
            return new ArticleRepo(
                new Article()
            );
        });
        $this->app->bind('gallery',function(){
            return new GalleryRepo(
                new Gallery()
            );
        });
    }
}