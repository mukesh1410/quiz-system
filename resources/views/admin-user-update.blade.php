<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-User-Update</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-navbar></x-navbar>
   <form method="POST" action="{{ route('user-update', ['id' => $user->id]) }}" class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label for="sno" class="block text-gray-700 font-semibold mb-2">S.No</label>
        <input type="text" name="sno" id="sno" value="{{$user->id}}" disabled 
               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
        <input type="hidden" name="sno" value="{{$user->id}}">
    </div>

    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
        <input type="text" name="name" id="name" required value="{{$user->name}}"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="mb-6">
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
        <input type="email" name="email" id="email" required  value="{{$user->email}}"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <button type="submit" 
            class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-300">
        Submit
    </button>
</form>

</body>
</html>