<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tailwind Background Test</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <x-user-navbar></x-user-navbar>
  <div class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6">Admin Signup</h2>
      @error('user')
        <div class="text-red-500">{{ $message }}</div>
      @enderror
      <form action="{{route('signup')}}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label for="" class="text-gray-600 mb-1">Admin name</label>
          <input type="text" placeholder="Enter Admin name" name="name"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('name')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div> 
        <div>
          <label for="" class="text-gray-600 mb-1">Admin password</label>
          <input type="password" placeholder="Enter Admin password" name="password"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('password')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <div>
          <label for="" class="text-gray-600 mb-1">Role</label>
          <input type="text" placeholder="Enter Admin role" name="role"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('role')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Signup</button>
        <div class="text-center">
          <span class="inline">Already have an account?</span>
          <a href="/admin-login" class="inline text-blue-500 hover:underline">Login now</a>
        </div>
      </form>
  </div> 
  </div>
</body>
</html>