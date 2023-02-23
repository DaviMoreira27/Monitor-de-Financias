<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class acessController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('user')){
            return redirect('/pag/register')->withErrors(['login' => 'É necessário fazer o login antes de prosseguir']);
        }

        return $next($request);
    }
}
