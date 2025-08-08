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
    <h2 class="text-2xl text-center text-gray-800 mb-6">Forgot Password</h2>
      {{-- @error('user')
        <div class="text-red-500">{{ $message }}</div>
      @enderror --}}
      <form action="/user-forgot-password" method="POST" class="space-y-4">
        @csrf
        <div>
          <input type="text" placeholder="Enter User email" name="email"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('email')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div> 
        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Submit</button>
        {{-- <div class="text-center">
          <span class="inline">Not a member?</span>
          <a href="/signup" class="inline text-blue-500 hover:underline">Signup now</a>
        </div> --}}
      </form>
  </div> 
  </div>
</body>
</html>