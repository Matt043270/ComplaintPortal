<?php
 
namespace App\Http\Middleware;

//use Auth;
use Closure;
use Illuminate\Support\Facades\Auth;
 
class AgentMiddleware
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
        if(!Auth::check() || (Auth::check() && Auth::user()->role == 'Agent')) {
 
            return $next($request);
        }
		elseif (Auth::check() || (Auth::check() && Auth::user()->role == 'User')) {
			return redirect('home');
		}
		else {
			return redirect('/admin');
		}
    }
	
}