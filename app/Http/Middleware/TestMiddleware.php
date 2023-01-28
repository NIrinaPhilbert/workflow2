<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
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
        //dd('test');
        //echo "test middleware personalise";
        $seconde = now()->format('s');//envoie le seconde de l'heurre en cours
        if($seconde % 2) {
           
            return $next($request);
        }
        return response('Vouis n etes pas autoris à visiter la page');
    }
}
