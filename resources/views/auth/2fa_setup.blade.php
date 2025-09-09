<div style="max-width:500px;margin:auto;">
    <h2>Two-Factor Authentication Setup</h2>
    <p>Google Authenticator app se niche QR code scan karein ya secret copy karein.</p>
    <div style="margin:20px;">{!! $google2fa_url !!}</div>
    <p><strong>Secret:</strong> {{ $secret }}</p>
    <form method="POST" action="{{ route('2fa.enable') }}">
        @csrf
        <label>OTP Code (Authenticator app se):</label><br>
        <input type="text" name="verify_code" required style="width:200px;"><br><br>
        <button type="submit">Verify & Enable 2FA</button>
    </form>
    @if(session('error'))
        <div style="color:red;margin-top:10px;">{{ session('error') }}</div>
    @endif
</div>