<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz System Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-user-navbar></x-user-navbar> 

    <div class="flex flex-col min-h-screen items-center bg-gray-100 pt-10">
        @if(session('message-success'))
            <div>
                <p class="text-green-500 font-bold">{{session('message-success')}}</p>
            </div>
        @endif

        @if (session('success'))
        <div> 
            <p class="text-green-500 font-bold">{{session('success')}}</p>
        </div>
        @endif
        <h1 class="text-4xl font-extrabold text-green-800 text-center my-10">Check Your Skills</h1>
        <div class="w-full max-w-md">
            <div class="relative">
                <form action="/search-quiz" method="GET">
                    <input class="w-full px-4 py-3 text-gray-700 border border-gray-300 rounded-2xl" name="search" type="text" placeholder="Search quiz...">
                    <button class="absolute right-2 top-3">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="w-full max-w-3xl">
        <div class="relative mb-6 pb-3">
            <h3 class="text-2xl font-bold text-green-900 text-center mt-5">
                Categories Lists
            </h3>
           @if (session('admin'))
                <a href="/categories/create" class="absolute right-0 top-1/2 -translate-y-1/2 inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg shadow hover:bg-green-700 transition">
                  <i class="fa-solid fa-plus"></i> Create
                </a>
           @endif 
      
        </div>
        <ul class="bg-white rounded-2xl shadow-md overflow-hidden divide-y divide-gray-200">
            <!-- Header -->
            <li class="bg-gray-100 font-semibold text-gray-600">
                <ul class="grid grid-cols-4 items-center text-center bg-neutral-300 px-6 py-3">
                    <li>S.NO</li>
                    <li>NAME</li>
                    <li>Total Quiz</li>
                    <li>VIEW</li>
                </ul>
            </li>

            <!-- Rows -->
            @foreach ($categories as $key=>$category)
                <li class="even:bg-gray-200">
                    <ul class="grid grid-cols-4 items-center text-center px-6 py-3">
                        <li>{{ $key+1 }}</li>
                        <li>{{ $category->name }}</li>
                        <li>{{ $category->quizzes_count }}</li>
                        <li>
                            <a href="user-quiz-list/{{ $category->id }}/{{ str_replace(' ','-',$category->name) }}">
                                <i class="fa-solid fa-eye cursor-pointer text-gray-600"></i>
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
        <div class="mt-5">{{ $categories->appends(request()->except('category_page'))->links() }}</div>
    </div>
    <div class="max-w-xl mx-auto">
    <h3 class="text-2xl font-bold text-green-900 text-center my-5">Quiz Lists</h3>

    <ul class="border border-gray-200 rounded-2xl shadow-md overflow-hidden divide-y divide-gray-200 mb-20">

        <!-- Header -->
        <li class="bg-gray-100 font-semibold text-gray-700">
            <ul class="bg-neutral-300 grid grid-cols-2 px-6 py-3">
                <li class="text-left">Name</li>
                <li class="text-right">Action</li>
            </ul>
        </li>

        <!-- Data Rows -->
        @foreach ($quizData as $item)
            <li class="even:bg-gray-200 bg-gray-100 ">
                <ul class="grid grid-cols-2 items-center px-6 py-3">
                    <!-- Quiz Name -->
                    <li class="text-left font-medium text-gray-800">
                        {{ $item->name }}
                    </li>

                    <!-- Action -->
                    <li class="text-right">
                        <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ','-',$item->name) }}"
                           class="inline-block px-4 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-lg hover:bg-green-200 transition">
                            Attempt Quiz
                        </a>
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>
    <div class="mt-[-60px] mb-[10px]">
    {{ $quizData->appends(request()->except('quiz_page'))->links() }}
    </div>
    </div>
    </div>
    <x-footer-user></x-footer-user>
</body>
</html>
