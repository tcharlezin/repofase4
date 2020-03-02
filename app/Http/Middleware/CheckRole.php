<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next, $role = 'client')
    {
        if(! Auth::check())
        {
            return redirect('/auth/login');
        }

        // Se for admin, pode tudo!
        if(Auth::user()->role == 'admin' )
        {
            return $next($request);
        }

        // Verifica a role passada por parâmetro
        if(Auth::user()->role != $role )
        {
            return redirect('/error/503');
        }

        return $next($request);
    }
}
