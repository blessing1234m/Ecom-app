<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Ecom-App')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.jpg') }}">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Ecom-App Logo" class="h-20 w-auto">
                        <span class="text-xl font-bold text-gray-800">Ecom-App Admin</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-gray-600 hover:text-primary-600 transition {{ request()->routeIs('admin.dashboard') ? 'text-primary-600 font-semibold' : '' }}">
                        Tableau de bord
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="text-gray-600 hover:text-primary-600 transition {{ request()->routeIs('admin.products.*') ? 'text-primary-600 font-semibold' : '' }}">
                        Produits
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="text-gray-600 hover:text-primary-600 transition {{ request()->routeIs('admin.categories.*') ? 'text-primary-600 font-semibold' : '' }}">
                        Catégories
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-gray-600 hover:text-primary-600 transition {{ request()->routeIs('admin.orders.*') ? 'text-primary-600 font-semibold' : '' }}">
                        Commandes
                    </a>
                    <a href="{{ route('admin.banners.index') }}"
                        class="text-gray-600 hover:text-primary-600 transition {{ request()->routeIs('admin.banners.*') ? 'text-primary-600 font-semibold' : '' }}">
                        Bannières
                    </a>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-600 transition text-sm"
                        target="_blank">
                        Voir le site
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-primary-600 transition text-sm">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile menu button -->
    <div class="md:hidden bg-white border-b border-gray-200">
        <div class="px-4 py-2">
            <button type="button" class="mobile-menu-button text-gray-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="mobile-menu hidden px-4 py-2 bg-white border-t border-gray-200">
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-gray-600 hover:text-primary-600 transition py-2 {{ request()->routeIs('admin.dashboard') ? 'text-primary-600 font-semibold' : '' }}">
                    Tableau de bord
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="text-gray-600 hover:text-primary-600 transition py-2 {{ request()->routeIs('admin.products.*') ? 'text-primary-600 font-semibold' : '' }}">
                    Produits
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="text-gray-600 hover:text-primary-600 transition py-2 {{ request()->routeIs('admin.orders.*') ? 'text-primary-600 font-semibold' : '' }}">
                    Commandes
                </a>
                <a href="{{ route('admin.banners.index') }}"
                    class="text-gray-600 hover:text-primary-600 transition py-2 {{ request()->routeIs('admin.banners.*') ? 'text-primary-600 font-semibold' : '' }}">
                    Bannières
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">@yield('page_title')</h1>
            @yield('breadcrumb')
        </div>

        <!-- Notifications -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Content -->
        @yield('content')
    </main>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])

    <script>
        // Mobile Menu Toggle
        document.querySelector('.mobile-menu-button')?.addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>
