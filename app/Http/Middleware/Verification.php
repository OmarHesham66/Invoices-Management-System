<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Verification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $person = auth()->user();
        if (is_null($person->email_verified_at) && !is_null($person->verifiy_code)) {
            return redirect()->route("auth.get_verify");
        }
        return $next($request);
    }
}
