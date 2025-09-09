<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2FA Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-lg mx-auto mt-10 bg-white shadow-lg rounded-lg p-6 border">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Two-Factor Authentication Setup</h2>

        <p class="text-gray-600 text-center mb-4">
            Google Authenticator app se niche QR code scan karein ya secret copy karein.
        </p>

        <div class="flex justify-center mb-4">
            {!! $google2fa_url !!}
        </div>

        <p class="text-center mb-6">
            <strong class="text-gray-700">Secret:</strong> 
            <span class="bg-gray-100 px-3 py-1 rounded-lg font-mono text-sm">{{ $secret }}</span>
        </p>

        <form method="POST" action="{{ route('2fa.enable') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">OTP Code (Authenticator app se):</label>
                <input type="text" name="verify_code" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                Verify & Enable 2FA
            </button>
        </form>

        @if(session('error'))
            <div class="mt-4 text-red-600 font-medium text-center">
                {{ session('error') }}
            </div>
        @endif
   </div>
</body>
</html>