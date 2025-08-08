<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="flex flex-col min-h-screen items-center bg-gray-100">
        <h1 class="text-4xl font-bold text-grenn-900 p-5">Attempted Quiz</h1>
        <div class="w-200">
        <ul class="border border-gray-200">
            <li class="p-2 font-bold">
                <ul class="flex justify-between">
                    <li class="w-50">S.NO</li>
                    <li class="w-100">NAME</li>
                    <li class="w-50">Status</li>
                </ul>
            </li>
            @foreach ($quizRecord as $key=>$record)
                <li class=" even:bg-gray-200 p-2">
                    <ul class="flex justify-between">
                        <li class="w-50">{{$key+1}}</li>
                        <li class="w-100">{{$record->name}}</li>
                        <li class="w-50">
                            @if ($record->status==2)
                                <span class="text-green-500">Completed</span>
                            @else
                                <span class="text-orange-500">Not Completed</span>
                            @endif
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    </div>
    <x-footer-user></x-footer-user>
</body>
</html>