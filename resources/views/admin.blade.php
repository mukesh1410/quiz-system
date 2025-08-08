<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar name={{$name}}></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
          <div class="w-full max-w-3xl">
            <h3 class="text-2xl font-bold text-blue-600 mb-4">Users List</h3>
            <ul class="bg-white rounded-2xl shadow overflow-hidden divide-y divide-gray-200">
                <li class="bg-gray-100 font-semibold text-gray-600">
                    <ul class="grid grid-cols-4 px-6 py-3">
                        <li>S.NO</li>
                        <li>NAME</li>
                        <li>EMAIL</li>
                    </ul>
                </li>
                @foreach ($users as $key => $user)
                    <li class="hover:bg-gray-50 transition">
                        <ul class="grid grid-cols-4 px-6 py-3 items-center">
                            <li class="w-30">{{ $key+1 }}</li>
                            <li class="w-70">{{ $user->name }}</li>
                            <li class="w-70">{{ $user->email }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            {{$users->links()}}
        </div>
    </div>
</body>
</html>