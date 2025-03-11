<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Проверяем, является ли пользователь администратором
                if (Auth::guard($guard)->user()->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                } else {
                    // Если пользователь не администратор, перенаправляем на главную страницу
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
