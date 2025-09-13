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
    @if (session('message-error'))
      <div>
        <p class="text-red-500 font-bold">{{session('message-error')}}</p>
      </div>
    @endif

     @if (session('message-success'))
      <div>
        <p class="text-green-500 font-bold">{{session('message-success')}}</p>
      </div>
    @endif
    <h2 class="text-2xl text-center text-gray-800 mb-6">User Login</h2>
      {{-- @error('user')
        <div class="text-red-500">{{ $message }}</div>
      @enderror --}}
      <a href="{{ URL::to('googleLogin') }}" class="w-full bg-red-500 rounded-xl px-4 py-2 text-white inline-block text-center">Login Via Google</a>
      <form action="/user-login" method="POST" class="space-y-4">
        @csrf
        <div>
          <label for="" class="text-gray-600 mb-1">User email</label>
          <input type="text" placeholder="Enter User email" name="email"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('email')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div> 
        <div>
          <label for="" class="text-gray-600 mb-1">User password</label>
          <input type="password" placeholder="Enter User password" name="password"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('password')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Login</button>
        {{-- <button type="submit" class="w-full bg-yellow-500 rounded-xl px-4 py-2 text-white">Login Via GitHub</button> --}}
        <a href="/user-forgot-password" class="text-green-500">Forget Password</a>
        <div class="text-center">
          <span class="inline">Not a member?</span>
          <a href="/user-signup" class="inline text-blue-500 hover:underline">Signup now</a>
        </div>
      </form>
  </div> 
  </div>
</body>
</html>