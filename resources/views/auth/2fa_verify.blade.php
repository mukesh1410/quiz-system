<form method="POST" action="{{ route('2fa.verify.post') }}">
    @csrf
    <label>Enter 2FA Code:</label>
    <input type="text" name="verify_code" value="{{ old('verify_code') }}" required />
    <button type="submit">Verify</button>
    
    @error('verify_code')
        <div style="color:red;">{{ $message }}</div>
    @enderror

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif
</form>
