<html lang="en" class="light">
<head>
    <title>Laravel Comments &mdash; @yield('page-title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>