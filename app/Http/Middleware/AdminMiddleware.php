<?php
 
namespace App\Http\Middleware;

//use Auth;
use Closure;
use Illuminate\Support\Facades\Auth;
 
class AdminMiddleware
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
        if(!Auth::check() || (Auth::check() && Auth::user()->role == 'Admin')) {
 
            return $next($request);
        }
		elseif (Auth::check() || (Auth::check() && Auth::user()->role == 'Agent')) {
			return redirect('/agent');
		}
		else {
			return redirect('home');
		}
    }
	
}