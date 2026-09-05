<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListingGrowth | Rank #1 on Amazon Organically</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Centralized CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>

<body>

    @include('frontend.layout.header')

    @yield('content')
    <!-- Footer -->
    @include('frontend.layout.footer')

    <!-- Centralized JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
