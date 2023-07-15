<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckClientLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('customer')->check())
        {
            $user = Auth::guard('customer')->user();
            if($user->status == 1)
            {
                return $next($request);
            }
            else{
                Session::put('error','Ban phai dang nhap de thuc hien chuc nang nay');
                Auth::guard('customer')->logout();
                return redirect()->route('get-client-home');
            }
        }
        else{
            Session::put('error','Ban phai dang nhap de thuc hien chuc nang nay');
            return redirect()->route('get-client-home');
        }
       
    }
}
