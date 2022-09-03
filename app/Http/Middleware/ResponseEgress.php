<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResponseEgress
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
        $response = $next($request);

        Log::info('[system_info][request_response_content]', [
            'request_path' => $request->getPathInfo(),
            'request_params' => $request->input(),
            'response' => $response->getContent()
        ]);
        return $response;
    }
}
