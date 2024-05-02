<?php

namespace App\Providers;

use App\ParseRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

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
        if (session_status() !== PHP_SESSION_ACTIVE) {
            //die('PHP session_start() must be called first.');
            session_start();
        }
        
        if (!Session::has('parse_health') || (Session::has('parse_health') && !Session::get('parse_health'))) {
            Session::put('parse_health', ParseRequest::InitParseRequest());
            Session::save();
        }
    }
}
