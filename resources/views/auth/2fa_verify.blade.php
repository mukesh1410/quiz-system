<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2FA Verify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <form method="POST" action="{{ route('2fa.verify.post') }}"
        class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6 border space-y-5 text-center">
        @csrf
        <label class="block text-lg text-gray-700 font-semibold mb-2">Enter 2FA Code:</label>
        <input type="text" name="verify_code" value="{{ old('verify_code') }}" required
            class="w-2/3 mx-auto border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-center font-mono text-xl tracking-widest" />

        <button type="submit"
                class="w-full mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200 text-lg">
            Verify
        </button>

        @error('verify_code')
            <div class="mt-3 text-red-600 font-medium">
                {{ $message }}
            </div>
        @enderror

        @if(session('success'))
            <div class="mt-3 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif
    </form>
</body>
</html>