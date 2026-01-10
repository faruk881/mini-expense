<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->user()->role !== 'user') {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthorized. Registred users only.'
            ], 403);
        }
        return $next($request);
    }
}
