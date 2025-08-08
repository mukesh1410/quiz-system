<nav class="bg-white shadow-md px-4 py-3">
    <div class="flex justify-between items-center">
        <div class="text-2xl text-gray-700 hover:text-blue-500 cursor-pointer">
            Quiz System
        </div>
        <div class="flex items-center space-x-4">
            <a href="/" class="text-green-900 hover:text-blue-500">Home</a>
            <a href="/categories-list" class="text-green-900 hover:text-blue-500">Categories</a>
            @if (Session('user'))
                <a href="/user-details" class="text-green-900 hover:text-blue-500">Welcome {{ session('user')->name }}</a>
                <a href="/user-logout" class="text-green-900 hover:text-blue-500">Logout</a>
            @else
                <a href="/user-login" class="text-green-900 hover:text-blue-500">Login</a>
                <a href="/user-signup" class="text-green-900 hover:text-blue-500">Signup</a>
            @endif
        </div>
    </div>
</nav>
