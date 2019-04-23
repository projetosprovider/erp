<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class CheckStatus
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
        if(!Auth::check()) {
            Auth::logout();
            return Redirect::route('home');
        }

        if(Auth::check() && Auth::user() && !Auth::user()->active) {
            Auth::logout();
            return Redirect::route('login')->withErrors('Desculpe, mas o Usuário está desativado, entre em contato com o Administrador.');
        }

        return $next($request);
    }
}
