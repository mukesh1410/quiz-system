<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <x-user-navbar></x-user-navbar>

    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <h1 class="text-2xl font-bold text-center text-green-800 mb-6 ">{{$quizName}}</h1>
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Question No. {{session('currentQuiz')['totalMcq']}}</h2>
        <h2 class="text-xl font-bold text-center text-green-700 mb-6">
            {{session('currentQuiz')['currentMcq']}} of {{session('currentQuiz')['totalMcq']}}</h2>
        <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-[460px]">
            <h3 class="text-green-900 font-bold text-xl mb-1">{{$mcqData->question}}</h3>
            <form action="/submit-next/{{$mcqData->id}}" class="space-y-4" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$mcqData->id}}">
                <label for="option_1" class="flex border  border-black p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
                    <input id="option_1" class="form-radio text-blue-500" type="radio" value="a" name="option">
                    <span class="text-green-900 pl-2">{{$mcqData->a}}</span>
                </label>
                <label for="option_2" class="flex border  border-black p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
                    <input id="option_2" class="form-radio text-blue-500" type="radio" value="b" name="option">
                    <span class="text-green-900 pl-2">{{$mcqData->b}}</span>
                </label>
                <label for="option_3" class="flex border  border-black p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
                    <input id="option_3" class="form-radio text-blue-500" type="radio" value="c" name="option">
                    <span class="text-green-900 pl-2">{{$mcqData->c}}</span>
                </label>
                <label for="option_4" class="flex border border-black p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
                    <input id="option_4" class="form-radio text-blue-500" type="radio" value="d" name="option">
                    <span class="text-green-900 pl-2">{{$mcqData->d}}</span>
                </label>
                <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white">Submit Answer and Next</button>
            </form>
        </div>
    </div>
    <x-footer-user></x-footer-user>
</body>
</html>