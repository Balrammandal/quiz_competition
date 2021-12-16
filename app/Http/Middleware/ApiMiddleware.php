<?php

namespace App\Http\Middleware;

use App\repo\Response;
use Closure;

class ApiMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tokenValid = $request->header('apiKey');
        if(isset($tokenValid) && $tokenValid =='fe8111bcad2df15caf00abf363bece492f3b7ab3'){
            return $next($request);
        }
        else {
            $data = [];
            $msg = 'Header not contain api key or Api key is not valid.';
            return Response::Error($data, $msg);
        }

    }
}
