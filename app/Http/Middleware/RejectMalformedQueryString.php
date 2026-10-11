<?php

namespace App\Http\Middleware;

use Closure;
use ErrorException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RejectMalformedQueryString
{
    /**
     * Reject query strings that PHP's parse_str() refuses (e.g. exceeding
     * max_input_vars or max_input_nesting_level) with a 400 instead of
     * letting later middleware such as HandleCors fail with a 500.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $request->getQueryString();
        } catch (ErrorException) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
