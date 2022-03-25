<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Auth_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = Session::get('admin_id');
		$name = Session::get('admin_name');
        if (isset($id) && isset($name)) {
            return $next($request);
        } else {
            return redirect('/admin-login');
        }
    }
}
