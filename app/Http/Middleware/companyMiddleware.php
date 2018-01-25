<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class companyMiddleware
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
       if(auth()->user()->isAdmin == 1){
         return $next($request);
       }elseif (auth()->user()->isAdmin == 2) {
         return $next($request);
       }
       return redirect('home')->with('msg','You have not company access');
     }
}
