<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'Book Review')</title>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto px-6 py-8">

    <header class="mb-8">
        <a href="{{ route('books.index') }}"
           class="text-3xl font-bold text-blue-600 hover:text-blue-700">
            📚 Book Review
        </a>
    </header>
    @yield('content')

</div>

</body>
</html>
