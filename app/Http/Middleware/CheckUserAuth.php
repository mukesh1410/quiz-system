<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckUserAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->get('user')) {
            return redirect()->route('user-login');
        }

        return $next($request);
    }
}
