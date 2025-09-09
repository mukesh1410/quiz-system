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
        // Agar session me user nhi hai to redirect kar do
        if (!session()->has('user')) {
            return redirect('user-login');
        }

        // Session se user id nikalo
        $userId = session('user')->id ?? session('user');

        // User ko DB se load karo
        $user = User::find($userId);
        if (!$user) {
            return redirect('user-login');
        }

        // Laravel Auth me login kara do
        Auth::login($user);

        // Next request ko allow karo
        return $next($request);
    }
}
