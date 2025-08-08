<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ str_replace(' ','-',$quizName)}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <x-user-navbar></x-user-navbar>
    @if(session('message-success'))
        <div>
            <p class="text-green-500 font-bold">{{session('message-success')}}</p>
        </div>
    @endif
    <div class="flex flex-col items-center py-10 space-y-10">
        <h1 class="text-4xl font-bold text-center text-green-700 mb-6">{{ str_replace(' ','-',$quizName)}}</h1>
        <h2 class="text-lg font-bold text-center text-green-700 mb-6">This Quiz container {{$quizCount}} Questions and no limit to attempt this Quiz</h2>
        <h1 class="text-2xl font-bold text-center text-green-700 mb-6">Good Luck</h1>
        @if (session('user'))
            <a href="/mcq/{{session('firstMCQ')->id.'/'.$quizName}}" type="submit" class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white">Start Quiz</a>
        @else
        <a href="/user-signup-quiz" type="submit" class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white">SignUp for Start Quiz</a>    
        <a href="/user-login-quiz" type="submit" class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white">Login for Start Quiz</a>
        @endif
    </div>
</body>
</html>