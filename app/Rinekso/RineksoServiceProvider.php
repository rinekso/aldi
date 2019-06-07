<?php namespace App\Rinekso;

use App\Rinekso\User\User;
use App\Rinekso\User\UserRepo;
use Illuminate\Support\ServiceProvider;
use App\Rinekso\Jenjang\JenjangRepo;
use App\Rinekso\Jenjang\Jenjang;
use App\Rinekso\Kelas\KelasRepo;
use App\Rinekso\Kelas\Kelas;

class RineksoServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->app->bind('users',function(){
            return new UserRepo(
                new User()
            );
        });
        $this->app->bind('jenjang',function(){
            return new JenjangRepo(
                new Jenjang()
            );
        });
        $this->app->bind('kelas',function(){
            return new KelasRepo(
                new Kelas()
            );
        });
    }
}