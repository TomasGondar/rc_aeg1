<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfProfessor
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && strpos($request->user()->email, '@aeg1.pt') !== false) {
            return $next($request);
        }
        return response()->json(['error' => 'Acesso não autorizado'], 403);
    }
}

