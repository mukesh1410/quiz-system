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
                        <th class="py-2 px-3 font-semibold">Delete</th>
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
                        <td class="py-2 px-3 text-center">

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
