<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Category : {{ str_replace('-', ' ', $category) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <x-user-navbar></x-user-navbar>

    @if ($quizData->isNotEmpty())
         <div class="max-w-3xl mx-auto py-8">
        <h2 class="text-xl text-center text-green-800 mb-6 font-semibold tracking-wide uppercase">
            Category : {{ str_replace('-', ' ', $category) }}
        </h2>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-green-700 text-white">
                        <th class="py-2 px-3 font-semibold">Quiz Id</th>
                        <th class="py-2 px-3 font-semibold">Name</th>
                        <th class="py-2 px-3 font-semibold">MCQ Count</th>
                        <th class="py-2 px-3 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizData as $item)
                    <tr class="border-b hover:bg-green-50 transition">
                        <td class="py-2 px-3 text-center">{{ $item->id }}</td>
                        <td class="py-2 px-3 font-medium text-center text-gray-700">{{ $item->name }}</td>
                        <td class="py-2 px-3 text-center">{{ $item->mcq_count }}</td>
                        <td class="py-2 px-3 text-center">
                            <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ','-', $item->name) }}"
                               class="inline-block px-3 py-1.5 bg-green-600 text-white rounded shadow hover:bg-green-700 transition font-semibold text-xs">
                                Attempt Quiz
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
           <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"><- Back To Home</a>
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
