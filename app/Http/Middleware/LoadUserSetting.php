<?php

namespace App\Http\Middleware;

use App\Laraption;
use Closure;
use \Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class LoadUserSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = Config::get('websettings.defaultLanguage');

        if(Auth::check()){
            $userSettings = Laraption::where('optkey','REGEXP','user.setting.'.Auth::id())
                ->get();

            foreach ($userSettings as $userSetting) {
                $optkey = str_replace('.'.Auth::id(),'',$userSetting->optkey);
                if($optkey == 'user.setting.language'){
                    $language = $userSetting->optvalue;
                }else{
                    Config::set($optkey, $userSetting->optvalue);
                }

                Config::set($optkey,$userSetting->optvalue);
            }

            Config::set('language',$language);

        }elseif(Cookie::get('language')){
            Config::set('language',Cookie::get('language'));
        }elseif(!Cookie::get('language')){
            Config::set('language',Config::get('websettings.defaultLanguage'));
        }
        //var_dump(Config::get('language'));
        //var_dump(Config::get('websettings.defaultLanguage'));
        //var_dump(Cookie::get('language').'cookem');

        return $next($request);
    }
}
