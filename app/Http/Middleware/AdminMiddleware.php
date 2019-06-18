<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Gate;

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
        //se não for admin manda pro não autorizado
        if (Gate::denies('admin-access'))
              return redirect()->route('nao_autorizado');

        return $next($request);
    }
}
