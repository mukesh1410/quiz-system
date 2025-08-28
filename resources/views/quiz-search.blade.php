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
   <x-user-navbar></x-user-navbar>
   @if ($quizData->isNotEmpty())
    <div class="flex flex-col items-center py-10 space-y-10">
        <h2 class="text-3xl mt-5 font-bold text-center text-green-700 mb-6">Search : {{ $quiz }}</h2>
        <div class="w-full max-w-3xl">
            <ul class="bg-white rounded-2xl shadow overflow-hidden divide-y divide-gray-200">
                <li class="bg-gray-100 font-semibold text-gray-600">
                    <ul class="grid grid-cols-4 px-6 py-3">
                        <li class="w-30">Quiz Id</li>
                        <li class="w-110">Name</li>
                        <li class="w-30">Mcq Count</li>
                        <li class="w-30">Action</li>
                    </ul>
                </li>
                @foreach ($quizData as $item)
                    <li class="hover:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-30">{{ $item->id }}</li>
                            <li class="w-110">{{ $item->name }}</li>
                            <li class="w-30">{{ $item->mcq_count }}</li>
                            <li class="w-30">
                                <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ','-', $item->name) }}" class="text-green-500 font-bold">
                                    Attempt Quiz
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @else
        <div class="flex mt-12 flex-col items-center justify-center h-64 bg-gray-50 rounded-lg">
            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M9 17v-3.14a4 4 0 0 1 .9-2.54l2.93-3.7c.32-.41.39-.98.16-1.45a1.08 1.08 0 0 0-1.56-.15l-3.14 2.81a4 4 0 1 1-5.92-5.13l2.64-3.19a4.06 4.06 0 0 1 5.82-.17l4.39 3.99a4.06 4.06 0 0 1 .15 5.82l-3.7 2.94a3.99 3.99 0 0 1-2.54.9H9z"/>
            </svg>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">No results found</h2>
            <p class="text-gray-500 mb-4">Try adjusting your search or filter to find what you’re looking for.</p>
            {{-- <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Go Home</button> --}}
            <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Go Home</a>
        </div>
    @endif
</body>
</html>