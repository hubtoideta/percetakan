<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthWithCategoryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {   
        if(Auth::check()){
            if(Auth::user()->category == $type){
                return $next($request);
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
