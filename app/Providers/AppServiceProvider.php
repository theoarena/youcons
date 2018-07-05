<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
//use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    private $pageTitle = "Youcons";
    private $useModal = false;   
    private $filter_ativo = false;   

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('ifUserType', function ($type) {
            return Auth::user()->hasRole($type);
        });
        
        View::share('pageTitle', $this->pageTitle);             
        View::share('useModal', $this->useModal);             
        View::share('filter_ativo', $this->filter_ativo);                              
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
