<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {            

            $auth = Auth::user()->roles()->first();
          // echo $auth->name;exit;
            switch ($auth->name) {
                case 'admin': return redirect()->route('admin'); break;
                case 'cliente': return redirect()->route('clientes'); break;
                case 'parceiro': return redirect()->route('clientes'); break;
                default: return redirect()->route('home');  break;
            }   

        }

        return $next($request);
    }
}
