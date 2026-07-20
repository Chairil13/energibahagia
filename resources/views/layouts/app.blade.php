<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Energi Bahagia') - Platform Donasi & Kebaikan</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Premium CSS Custom -->
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">

    @stack('styles')
</head>

<body class="antialiased bg-gray-50">
    <!-- Navbar Component -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('components.footer')

    @stack('scripts')
</body>

</html>
