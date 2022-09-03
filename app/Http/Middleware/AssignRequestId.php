<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AssignRequestId
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request                                                                          $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestId = (string)Str::uuid();

        Log::withContext([
            'request-id' => $requestId
        ]);
        $request->headers->set('Request-Id', $requestId);
        return $next($request);
    }
}
