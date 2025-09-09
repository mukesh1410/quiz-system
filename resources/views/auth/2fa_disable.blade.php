<div style="max-width:400px;margin:auto;">
    <h2>Disable Two-Factor Authentication</h2>
    <form method="POST" action="{{ route('2fa.disable.post') }}">
        @csrf
        <button type="submit" style="background:#e74c3c;color:white;">Disable 2FA</button>
    </form>
    @if(session('success'))
        <div style="color:green;margin-top:10px;">{{ session('success') }}</div>
    @endif
</div>
