<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2FA Disable</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6 text-center border">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Disable Two-Factor Authentication</h2>
    
    <form method="POST" action="{{ route('2fa.disable.post') }}">
        @csrf
        <button type="submit" 
            class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Disable 2FA
        </button>
    </form>
    
    @if(session('success'))
        <div class="mt-4 text-green-600 font-medium">
            {{ session('success') }}
        </div>
    @endif
</div>

</body>
</html>