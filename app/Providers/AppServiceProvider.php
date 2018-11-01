<?php

namespace App\Providers;

use App\Laraption;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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

        /*Force To HTTPS*/
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        ///Load System JSON Settings
        $getSetting = Laraption::where('optkey','webSetting')->first() ?? false;
        if(isset($getSetting) && $getSetting){

        $settings = json_decode($getSetting->optvalue);
        foreach ($settings as $key => $setting){
            Config::set('websettings.'.$key, $setting);
        }
        }

        ///Load System Setting.

        $getSets = Laraption::where('optkey','REGEXP','system.setting.')
            ->get();

        foreach ($getSets as $gSetting){
            Config::set($gSetting->optkey, $gSetting->optvalue);
        }



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
