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

    @if (session('category'))
        <div class="bg-green-600 text-white text-center py-2 font-semibold shadow-md">
            {{ session('category') }}
        </div>
    @endif
    
    <div class="flex flex-col items-center py-10 space-y-10">

        <!-- Add Category Form -->
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">Add New Category</h2>
            <form action="/add-category" method="POST" class="space-y-5">
                @csrf
                <input
                    type="text"
                    name="category"
                    placeholder="Enter Category Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                @error('category')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-xl transition duration-200"
                >
                    Add Category
                </button>
            </form>
        </div>

        <!-- Category List -->
        <div class="w-full max-w-3xl">
            <h3 class="text-2xl font-bold text-blue-600 mb-4">Categories Lists</h3>
            <ul class="bg-white rounded-2xl shadow overflow-hidden divide-y divide-gray-200">
                <li class="bg-gray-100 font-semibold text-gray-600">
                    <ul class="grid grid-cols-4 bg-neutral-400 px-6 py-3">
                        <li>S.NO</li>
                        <li>NAME</li>
                        <li>CREATOR</li>
                        <li>ACTION</li>
                    </ul>
                </li>
                @foreach ($categories as $category)
                    <li class="hover:bg-gray-100 transition">
                        <ul class="grid grid-cols-4 px-6 py-3 items-center">
                            <li class="w-30">{{ $category->id }}</li>
                            <li class="w-70">{{ ucfirst(strtolower($category->name)) }}</li>
                            <li class="w-70">{{ $category->creator }}</li>
                            <li class="w-30 flex">
                                <a href="{{route('delete',$category->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="#888">
                                       <path d="M5.5 17q-.625 0-1.062-.438Q4 16.125 4 15.5v-10h-.5v-1h4v-1h5v1h4v1H16v10q0 .625-.438 1.062Q15.125 17 14.5 17ZM6 14h1v-6H6Zm3 0h1v-6H9Zm3 0h1v-6h-1Z"/>
                                    </svg>
                                </a>
                                <a href="quiz-list/{{$category->id}}/{{$category->name}}">
                                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#888"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
            <div class="mt-5">{{$categories->links()}}</div>
        </div>
    </div>
</body>
</html>
