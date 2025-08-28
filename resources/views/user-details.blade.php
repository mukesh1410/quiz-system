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
    <div class="flex flex-col items-center mt-10 min-h-screen bg-gray-100 px-4 py-6">
    <h1 class="text-4xl font-bold text-green-900 mb-8">Attempted Quiz</h1>
    <div class="w-full max-w-3xl overflow-x-auto bg-white rounded-lg shadow border border-gray-300">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-green-100">
            <tr>
            <th class="px-6 py-3 text-left text-xs font-semibold text-green-700 uppercase w-20">S.NO</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-green-700 uppercase">Name</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-green-700 uppercase w-32">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach ($quizRecord as $key => $record)
            <tr class="@if($loop->even) bg-gray-50 @endif">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $key + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $record->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                @if($record->status == 2)
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">Completed</span>
                @else
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">Not Completed</span>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
    <x-footer-user></x-footer-user>
</body>
</html>