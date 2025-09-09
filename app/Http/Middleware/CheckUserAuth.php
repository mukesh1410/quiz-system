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
        // Check if user session exists
        if (!session()->has('user')) {
            return redirect()->route('user-login');
        }

        // Get user ID from session
        $userId = is_object(session('user')) ? session('user')->id : session('user');

        // Fetch user from database
        $user = User::find($userId);

        // If user not found in DB, logout and clear session
        if (!$user) {
            Auth::logout();
            session()->flush();
            return redirect()->route('user-login')->withErrors('User account deleted or does not exist.');
        }

        // If not already authenticated, login user
        if (!Auth::check() || Auth::id() !== $user->id) {
            Auth::login($user);
        }

        // Allow next middleware/request
        return $next($request);
    }
}
