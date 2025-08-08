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

    <div class="flex flex-col items-center py-10 space-y-10">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-6">Search : {{$quiz}}</h2>
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
                                <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ','-', $itemName)}}" class="text-green-500 font-bold">
                                    Attempt Quiz
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