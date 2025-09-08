<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Signup Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<x-user-navbar></x-user-navbar>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6">User SignUp</h2>
      @error('user')
        <div class="text-red-500">{{ $message }}</div>
      @enderror
      @if (session('message'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong class="font-bold">{{session('message')}}</strong>
          </div>
      @endif
      <form action="{{route('verify.otp.store')}}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label for="otp" class="text-gray-600 mb-1">Enter OTP</label>
          <input type="password" placeholder="Enter your OTP" name="otp"
          class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
          @error('otp')
           <div class="text-red-500">{{ $message }}</div>
          @enderror
          <button class="bg-black mt-2 rounded-md p-2 text-white">VERIFY & REGISTER</button>
        </div> 
      </form>
  </div> 
</div>
</body>
</html>