<?php

namespace App\Http\Middleware;
use App\Http\Middleware\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

		
		if (Auth::guard('admin')->admin()) {
			echo "admin";
			$user = Auth::user();
            return $next($request);
        }
        /*if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect(route('admin/login'));
        }*/
		 return $next($request);
		
    }
}
