<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Channel;
use View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap(); 
        View::composer('*', function ($view) {
            $channels = \Cache::rememberForever('channels' , function(){
                return Channel::all();
            });
            $view->with('channels', $channels); 
        });
    }
}
