<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Crypt;
use App;
use Config;

class SetLocale
{
    
    /**
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->hasCookie('lang') != false) {

            $locale = Crypt::decrypt(Cookie::get('lang'), false);

        } 

        else {

            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if ($locale != 'fr' && $locale != 'en') {

                $locale = 'en';

            }

        }

        App::setLocale($locale);

        return $next($request);

    }

}
