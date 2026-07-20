<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="@yield('meta_description', 'Energi Bahagia adalah platform donasi terpercaya untuk program pendidikan, kesehatan, sosial, kemanusiaan, ekonomi, dan lingkungan.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('title', 'Energi Bahagia') - Platform Donasi & Kebaikan">
    <meta property="og:description"
        content="@yield('meta_description', 'Energi Bahagia adalah platform donasi terpercaya untuk berbagi kebaikan secara mudah dan transparan.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:type" content="website">
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
