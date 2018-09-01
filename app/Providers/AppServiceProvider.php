<?php

namespace App\Providers;

use App\Laraption;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        ///Load Settings
        $settings = json_decode(Laraption::where('optkey','webSetting')->first()->optvalue);
        foreach ($settings as $key => $setting){
            Config::set('websettings.'.$key, $setting);
        }
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
