<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Certificate of Achievement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-100 via-green-200 to-green-100 min-h-screen flex items-center justify-center p-10">

    <div class="bg-white max-w-4xl w-full rounded-3xl shadow-2xl border-8 border-green-500 p-12 text-center relative">

        <!-- Navigation -->
        <div class="absolute top-6 left-8">
            <a href="/" class="hover:text-green-700 font-semibold text-green-600 transition">⬅ Back</a>
        </div>
        <div class="absolute top-6 right-8">
            <a href="/download-certificate" class="hover:text-green-700 font-semibold text-green-600 transition">⬇ Download</a>
        </div>

        <!-- Certificate Logo -->
        <svg class="mx-auto mb-8 text-green-500 w-16 h-16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12m0 0-5.25-5m5.25 5H3"></path>
        </svg>

        <h1 class="text-5xl font-bold text-green-700 mb-6">Certificate of Achievement</h1>

        <p class="text-lg text-gray-700 mb-3">This certifies that</p>

        <h2 class="text-3xl font-semibold text-gray-800 mb-4">{{$data['name']}}</h2>

        <p class="text-lg text-gray-700 mb-2">has successfully completed the</p
