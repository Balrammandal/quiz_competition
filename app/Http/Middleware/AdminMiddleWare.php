<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleWare
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
        if(isset(Auth::user()->id)) {
            $user_type = Auth::user()->user_type;
            if($user_type=='Admin'){
                return $next($request);
            }else{
                return redirect(url('/admin'));
            }

        }else{
            return redirect(url('/admin'));
        }
    }
}
