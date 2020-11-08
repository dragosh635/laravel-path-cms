<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyIsAdmin {
    /**
     * If the user is not an administrator, redirect to homepage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle( Request $request, Closure $next ) {
        if ( ! auth()->user()->isAdmin() ) {
            return redirect('/home');
        }

        return $next( $request );
    }
}
