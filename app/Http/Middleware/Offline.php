<?php

namespace App\Http\Middleware;

use Closure;

class Offline
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
        $offline = \System::getValue('system', 'offline');
        if($offline == 1) return response()->view('errors.offline');
        return $next($request);
    }
}
