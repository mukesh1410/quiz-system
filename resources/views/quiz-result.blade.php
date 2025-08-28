<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar Component -->
    <x-user-navbar></x-user-navbar>

    <!-- Main Container -->
    <div class="flex flex-col min-h-screen items-center px-4">
        
        <!-- Quiz Result Heading -->
        <h1 class="pt-10 text-3xl font-extrabold text-green-800 text-center my-6">
            Quiz Result
        </h1>
        @if ($correctAnswers*100/count($resultData) > 30)
                <a class="text-green-500 font-bold block" href="/certificate">View and Download Certificate</a>
        @endif       
         <!-- Result Box -->
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6">
            <!-- Category Heading -->
            <h2 class="text-2xl font-semibold text-green-700 text-center mb-6">
                {{$correctAnswers}} out of {{count($resultData)}} Correct
            </h2>

            <!-- Result Table -->
            <ul class="border border-gray-300 rounded">
                <!-- Table Header -->
                <li class="bg-green-100 font-bold p-3 rounded-t">
                    <ul class="flex justify-between text-green-900">
                        <li class="w-1/6">S.NO</li>
                        <li class="w-3/6">Question</li>
                        <li class="w-2/6">Result</li>
                    </ul>
                </li>

                <!-- Loop Through Result Data -->
                @foreach ($resultData as $key => $item)
                    <li class="@if($key % 2 == 0) bg-gray-100 @endif p-3">
                        <ul class="flex justify-between items-center">
                            <li class="w-1/6">{{ $key + 1 }}</li>
                            <li class="w-3/6">{{ $item->question }}</li>
                            <li class="w-2/6 font-medium {{ $item->is_correct ? 'text-green-600' : 'text-red-600' }}">
                                {{ $item->is_correct ? 'Correct' : 'Incorrect' }}
                            </li>
                        </ul>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</body>
</html>
