<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
{
    public function handle($request, Closure $next)
    {

        if (! auth('client')->check()) {
            $redirect = [];
            $redirect['route'] = url()->previous();
            // $redirect['route'] = request()->route()->getName();
            // $redirect['method'] = $request->method();
            // $redirect['parameters'] = $request->route()->parameters();
            // $redirect['request'] = $request->all();
            session()->put('redirect', $redirect);

            return redirect()->route('client.login');
        }

        return $next($request);
    }
}
