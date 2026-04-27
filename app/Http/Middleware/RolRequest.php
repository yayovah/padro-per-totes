<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RolRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rols): Response
    {
        Log::channel('dev')->info("{$request->method()} - {$request->fullUrl()}"); 
        $allowedRoles = explode('|', $rols);

        // Si l'usuari no té un rol permès, aborta
        if (!in_array($request->user()->rol, $allowedRoles)) {
            Log::channel('dev')->info("User:{$request->user()} - {$request->fullUrl()} - 403 ERROR"); 
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
