<nav class="bg-neutral-400 fixed top-0 left-0 w-full z-50 shadow-md px-4 py-3">
    <div class="flex justify-between items-center">
        <a href="/" class="text-2xl text-black hover:text-white cursor-pointer">Quiz System</a>
        <div class="flex items-center space-x-4">
            <a href="/admin-login" class="text-black hover:text-white">Admin Panel</a>
            <a href="/" class="text-black hover:text-white">Home</a>
            <a href="/categories-list" class="text-black hover:text-white">Categories</a>
            @if (Session('user'))
                <a href="/user-details" class="text-black hover:text-white">Welcome {{ ucfirst(strtolower(session('user')->name)) }}</a>
                <a href="/user-logout" class="text-black hover:text-white">Logout</a>
            @else
                <a href="/user-login" class="text-black hover:text-white">User Panel</a>
                {{-- <a href="/user-login" class="text-black hover:text-white">Login</a> --}}
                    {{-- <a href="/user-signup" class="text-black hover:text-white">Signup</a> --}}
            @endif
        </div>
    </div>
</nav>

