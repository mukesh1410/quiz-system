<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <x-navbar name="{{ $name }}"></x-navbar>

    <div class="flex flex-col items-center py-10 space-y-10">

        <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">Category Name : {{$category}}  <a href="/add-quiz" class="text-yellow-500 text-sm">Back</a></h2>
        <div class="w-full max-w-3xl">
            <ul class="bg-white rounded-2xl shadow overflow-hidden divide-y divide-gray-200">
                <li class="bg-gray-100 font-semibold text-gray-600">
                    <ul class="grid grid-cols-4 px-6 py-3">
                        <li class="w-30">Quiz Id</li>
                        <li class="w-140">Name</li>
                        <li class="w-30">Action</li>
                    </ul>
                </li>
                @foreach ($quizData as $item)
                    <li class="hover:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-30">{{ $item->id }}</li>
                            <li class="w-140">{{ $item->name }}</li>
                            <li class="w-30">  
                                <a href="/show-quiz/{{$item->id}}/{{$item->name}}">
                                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#888"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>