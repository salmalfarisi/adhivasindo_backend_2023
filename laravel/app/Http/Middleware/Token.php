<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
		$cekdata = DB::table('oauth_access_tokens')->where('id', $token)->count();
		if($cekdata == 1)
		{
			return $next($request);
		}
		else
		{
			return response(['error'=>'Unauthorized', 'status' => 401], 401);
		}
    }
}
