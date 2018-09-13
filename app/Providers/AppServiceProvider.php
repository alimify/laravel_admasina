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
        $getSetting = Laraption::where('optkey','webSetting')->first() ?? false;
        if(isset($getSetting) && $getSetting){

        $settings = json_decode($getSetting->optvalue);
        foreach ($settings as $key => $setting){
            Config::set('websettings.'.$key, $setting);
        }

            $getSets = Laraption::where('optkey','REGEXP','system.setting.')
                ->get();

            foreach ($getSets as $gSetting){
                Config::set($gSetting->optkey, $gSetting->optvalue);
            }

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
