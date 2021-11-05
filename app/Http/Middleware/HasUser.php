<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Rushmore;
use App\Http\Controllers\Auth\LoginController;

class HasUser
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
        if( $request->has('state') && $request->has('id_token') ){
            LoginController::consumeToken( $request->state, $request->id_token );
            return redirect()->route('dashboard');
        }

        $tmp_user = json_decode(session('user'));

        if( isset($tmp_user->name) && !session('demo') && $tmp_user->name == 'Demo User' ){
            session()->forget('user');
        } else if ( $tmp_user ) {
            return $next($request);
        }

        return redirect()->away( resolve('App\Services\Rushmore')->signInURL() );
        // abort(403);
    }
}
