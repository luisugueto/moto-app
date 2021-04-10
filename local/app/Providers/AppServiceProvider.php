<?php

namespace App\Providers;
use App\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('current_password', function($attribute, $value, $parameters) {
            return Hash::check($value, auth()->user()->password);
        });

        view()->composer('layouts.backend', function($view){
            $view->with('menus', Menu::menus());
        });
        
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
