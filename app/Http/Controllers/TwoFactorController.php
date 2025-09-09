<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Google2FA;
use Auth;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->middleware('auth');
        $this->google2fa = $google2fa;
    }

    public function setup()
    {
        $user = Auth::user();
        if ($user->google2fa_secret === null) {
            // Naya secret generate karein
            $user->google2fa_secret = $this->google2fa->generateSecretKey();
            $user->save();
        }
        // QR code generate karein
        $google2fa_url = $this->google2fa->getQRCodeInline(
            config('app.name'), // app name
            $user->email,       // user ka email  
            $user->google2fa_secret // secret key
        );
        return view('auth.2fa_setup', [
            'google2fa_url' => $google2fa_url,
            'secret' => $user->google2fa_secret
        ]);
    }

    // OTP verify aur enable karne wala function
    public function enable(Request $request)
    {
        $request->validate([
            'verify_code' => 'required|numeric',
        ]);
        $user = Auth::user();
        $valid = $this->google2fa->verifyKey(
            $user->google2fa_secret,
            $request->input('verify_code')
        );

        if ($valid) {
            // Success, enable kar diya
            return redirect()->route('home')->with('success', '2FA Successfully Enabled!');
        } else {
            return redirect()->back()->with('error', 'Code galat hai, dobara try karein.');
        }
    }

    public function showDisableForm()
    {
        return view('auth.2fa_disable');
    }

    public function disable(Request $request)
    {
        $user = Auth::user();
        $user->google2fa_secret = null;
        $user->save();

        session()->forget('2fa_verified'); // flag clear karen

        return redirect()->route('home')->with('success', '2FA Disabled.');
    }

   public function showVerifyForm()
    {
        return view('auth.2fa_verify');  // 2FA code input form yeh dikhayega
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verify_code' => 'required|numeric',
        ]);

        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->verify_code);
        if ($valid) {
            session(['2fa_verified' => true]);
            // 2FA sahi hone par user ko home page ya dashboard pe bhejo
            return redirect()->route('home')->with('success', '2FA Verified Successfully');
        } else {
            // Galat hone par error message ke saath wapas bhejo
            return back()->withErrors(['verify_code' => 'Invalid verification code'])->withInput();
        }
    }
}
