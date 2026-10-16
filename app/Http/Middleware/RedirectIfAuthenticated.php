<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Arahkan ke dashboard sesuai peran. HOME ('/') adalah halaman login yang memakai
                // middleware guest, jadi redirect ke sana menimbulkan loop.
                $dashboard = [
                    'admin' => 'a.dashboard',
                    'kasir' => 'k.dashboard',
                    'owner' => 'o.dashboard',
                ][Auth::guard($guard)->user()->role] ?? null;

                if ($dashboard) {
                    return redirect()->route($dashboard);
                }

                Auth::guard($guard)->logout();
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
