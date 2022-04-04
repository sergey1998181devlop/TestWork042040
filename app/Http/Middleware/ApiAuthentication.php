<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Response;
class ApiAuthentication
{

    public function handle(Request $request, Closure $next): \Illuminate\Http\JsonResponse
    {
        if($request->header('Authorization') !== env('TOKEN_AUTH'))
        {
            $response = [
                'status' => 401,
                'message' => 'Unauthorized',
            ];

            return response()->json($response, 413);
        }
        else
        {
            return $next($request);
        }
    }
}
