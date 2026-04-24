<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->two_factor_code) {
            if (Auth::user()->two_factor_expires_at < now()) {
                Auth::user()->resetTwoFactorCode();
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Kode 2FA kedaluwarsa.']);
            }

            if (!$request->is('verify-2fa*')) {
                return redirect()->route('verify-2fa.index');
            }
        }
        return $next($request);
    }
}
