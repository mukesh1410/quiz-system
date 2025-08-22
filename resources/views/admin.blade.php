<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-navbar name={{$name}}></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <div class="w-full max-w-3xl">
            <h3 class="text-2xl font-bold text-blue-600 mb-4 text-center">Users Lists</h3>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white font-bold">
                <ul class="grid grid-cols-6 px-6 py-3">
                    <li>S.NO</li>
                    <li>NAME</li>
                    <li>EMAIL</li>
                    <li>VIEW</li>
                    <li>UPDATE</li>
                    <li>DELETE</li>
                </ul>
            </div>

            <!-- Data Rows -->
            <ul class="divide-y divide-gray-200">
                @foreach ($users as $key => $user)
                    <li class="hover:bg-green-50 transition">
                        <ul class="grid grid-cols-6 px-6 py-4 items-center">
                            <!-- S.NO -->
                            <li class="font-medium text-gray-700">{{ $user->id }}</li>
                            
                            <!-- Name -->
                            <li class="text-gray-900 font-semibold">{{ $user->name }}</li>
                            
                            <!-- Email -->
                            <li title="{{ $user->email }}" class="truncate text-gray-600">{{ $user->email }}</li>
                            
                            <!-- View -->
                            <li>
                                <a href="{{route('user-view', $user->id)}}" class="text-green-600 hover:text-green-800 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </li>

                            <!-- Update -->
                            <li>
                                <a href="{{route('user-get', $user->id)}}" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </li>

                            <!-- Delete -->
                            <li>
                                <form method="POST" action="{{ route('user-delete', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition bg-transparent border-0 p-0 cursor-pointer">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        </div>
        <div>
            <div class="mt-2 ml-60">{{$users->links()}}</div>
        </div>
    </div>
</body>
</html>