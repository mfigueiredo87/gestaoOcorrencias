<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        //se o usuario nao iniciar sessao, redirecionara pra login
        if(! auth()->check())
            return redirect('login');
        //verifica se o usuario nao for administrador, vai ser redirecionado para a home
        if (auth()->user()->role != 0)//se nao for administrador manda para home

            return redirect('home');

        return $next($request);
    }
}
