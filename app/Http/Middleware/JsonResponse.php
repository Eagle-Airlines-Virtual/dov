<?php
/**
 * Set the content type in the API layer
 */

namespace App\Http\Middleware;

use App\Contracts\Middleware;
use Closure;
use Illuminate\Http\Request;

class JsonResponse implements Middleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('charset', 'utf-8');
        $response->headers->set('Access-Control-Allow-Origin', implode(',', config('cors.allowed_origins')));
        $response->headers->set('Access-Control-Allow-Methods', implode(',', config('cors.allowed_methods')));
        $response->headers->set('Access-Control-Allow-Headers', implode(',', config('cors.allowed_headers')));
        $response->headers->set('Access-Control-Allow-Credentials', config('cors.supports_credentials'));

        return $response;
    }
}
