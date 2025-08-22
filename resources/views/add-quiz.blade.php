<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Quiz Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <x-navbar name="{{ $name }}"></x-navbar>

    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
       <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            @if (!session()->has('quizDetails'))
            <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">Add Quiz</h2>
            <form action="/add-quiz" method="GET" class="space-y-5">
                <div>
                    <input
                        type="text"
                        name="quiz"
                        required
                        placeholder="Enter Quiz Name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <div>
                    <select
                        type="text"
                        name="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                    @foreach ($categories as $category)
                      <option value={{$category->id}}>{{ucfirst(strtolower($category->name))}}</option>
                    @endforeach
                    </select>
                </div>
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-xl transition duration-200"
                >
                    Add
                </button>
            </form>   
            @else 
            <span class="text-green-500 font-bold">Quiz : {{session('quizDetails')->name}}</span>
            <span class="text-green-500 font-bold block">Total MCQs : {{$totalMCQs}}
                @if ($totalMCQs > 0)
                    <a class="text-yellow-500 text-sm" href="/show-quiz/{{session('quizDetails')->id}}">Show MCQs</a>
                @endif
            </span>
            <h2 class="text-3xl font-bold text-center text-gray-700 mb-6">Add MCQs</h2>
            <form method="POST" action="add-mcq" class="space-y-4">
                <div>
                    @csrf
                    <textarea type="text" placeholder="Enter your question" name="question" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none"></textarea>
                    @error('question')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    <input type="text" placeholder="Enter first option" name="a" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('a')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                   <div>
                    <input type="text" placeholder="Enter second option" name="b" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('b')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                   <div>
                    <input type="text" placeholder="Enter third option" name="c" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                     @error('c')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                   <div>
                    <input type="text" placeholder="Enter fourth option" name="d" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('d')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    <select name="correct_ans" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                        <option value="">Select Right Answer</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                    @error('correct_ans')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <button
                    type="submit"
                    value="add-more"
                    name="submit"
                    class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white"
                >
                    Add More
                </button>
                <button
                    type="submit"
                    value="done"
                    name="submit"
                    class="w-full bg-green-500 rounded-xl px-4 py-2 text-white"
                >
                    Add and Submit
                </button>
                <a href="/end-quiz" class="w-full bg-red-500 rounded-xl px-4 py-2 text-white block text-center" >Finish Quiz</a>
            </form>
            @endif
        </div>
    </div>
</body>