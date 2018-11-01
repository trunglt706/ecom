<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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
        $lang = $request->segment(1);
        $chkLang = \Language::where('public', 1)->where('alias', $lang)->first();
        if(is_null($chkLang)) abort(404);
        \App::setLocale($chkLang->lang_code);
        return $next($request)->withCookie(cookie('locale', $lang));
    }
}
