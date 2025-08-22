<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-navbar></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <div class="w-full max-w-3xl">
            <h3 class="text-2xl font-bold text-blue-600 mb-4 text-center">User List</h3>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white font-bold">
                <ul class="grid grid-cols-3 px-6 py-3">
                    <li>S.NO</li>
                    <li>NAME</li>
                    <li>EMAIL</li>
                </ul>
            </div>

            <!-- Data Rows -->
            <ul class="divide-y divide-gray-200">
                @foreach ($user as $u)
                    <li class="hover:bg-green-50 transition">
                        <ul class="grid grid-cols-3 px-6 py-4 items-center">
                            <!-- S.NO -->
                            <li class="font-medium text-gray-700">{{ $u->id }}</li>
                            
                            <!-- Name -->
                            <li class="text-gray-900 font-semibold">{{ $u->name }}</li>
                            
                            <!-- Email -->
                            <li class="truncate text-gray-600">{{ $u->email }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="{{route('dashboard')}}"
        class="inline-flex mt-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow ">
        ← Back
        </a>
        </div>
        <div>
            {{-- <div class="mt-2 ml-60">{{$use->links()}}</div> --}}
        </div>
    </div>
    <x-footer-user></x-footer-user>
</body>
</html>