<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'The 2-Pizza Company' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200 text-base-content" data-theme="luxury">
    <main class="container mx-auto py-10">
        @yield('content')
    </main>

    <footer class="footer footer-center p-10 bg-primary text-primary-content">
        <p>© 2025 The 2-Pizza Company. All rights reserved.</p>
    </footer>
</body>
</html>
