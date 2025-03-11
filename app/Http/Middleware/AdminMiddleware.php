<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, аутентифицирован ли пользователь
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Проверяем, является ли пользователь администратором
        if (Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Если пользователь не администратор, перенаправляем на главную страницу с сообщением
        return redirect('/')->with('error', 'У вас нет доступа к админ-панели.');
    }
}