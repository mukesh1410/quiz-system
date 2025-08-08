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

        <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">All Current Quiz's MCQs  <a href="/add-quiz" class="text-yellow-500 text-sm">Back</a></h2>
        <div class="w-full max-w-3xl">
            <ul class="bg-white rounded-2xl shadow overflow-hidden divide-y divide-gray-200">
                <li class="bg-gray-100 font-semibold text-gray-600">
                    <ul class="grid grid-cols-4 px-6 py-3">
                        <li>MCQ Id</li>
                        <li>Question</li>
                    </ul>
                </li>
                @foreach ($mcqs as $mcq)
                    <li class="hover:bg-gray-200 p-2">
                        <ul class="flex justify-between">
                            <li class="w-30">{{ $mcq->id }}</li>
                            <li class="w-170">{{ $mcq->question }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
