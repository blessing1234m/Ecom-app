<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ecom-App')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.jpg') }}">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Ecom-App Logo" class="h-10 w-auto">
                        <span class="text-xl font-bold text-gray-800">Ecom-App</span>
                    </a>
                </div>

                <!-- Navigation Desktop -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-black font-semibold hover:text-primary-600 transition {{ request()->routeIs('home') ? 'text-primary-600 underline underline-offset-4 font-bold' : '' }}">ACCUEIL</a>
                    <a href="{{ route('products.index') }}"
                        class="text-black font-semibold hover:text-primary-600 transition {{ request()->routeIs('products.*') ? 'text-primary-600 underline underline-offset-4 font-bold' : '' }}">BOUTIQUE</a>
                    <a href="{{ route('blogs.index') }}"
                        class="text-black font-semibold hover:text-primary-600 transition {{ request()->routeIs('blogs.*') ? 'text-primary-600 underline underline-offset-4 font-bold' : '' }}">BLOG</a>
                    {{-- <a href="{{ route('cart.index') }}"
                        class="text-black font-semibold hover:text-primary-600 transition {{ request()->routeIs('cart.*') ? 'text-primary font-bold' : '' }}">VOTRE
                        PANNIER</a> --}}
                </nav>

                <!-- Barre de recherche - Desktop -->
                <div class="hidden md:flex flex-1 max-w-xs mx-4">
                    <form action="{{ route('products.index') }}" method="GET" class="w-full">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Rechercher un produit..."
                                class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Section Droite -->
                <div class="flex items-center space-x-4">
                    <!-- Icône Recherche - Mobile -->
                    <button type="button"
                        class="md:hidden text-gray-600 hover:text-primary-600 transition mobile-search-button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Icône Panier -->
                    <a href="{{ route('cart.index') }}"
                        class="relative text-gray-600 hover:text-primary-600 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center cart-count">0</span>
                    </a>

                    <!-- Bouton Menu Mobile -->
                    <button type="button" class="md:hidden text-gray-600 mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Barre de recherche - Mobile -->
            <div class="md:hidden mobile-search hidden mt-4 pb-2">
                <form action="{{ route('products.index') }}" method="GET" class="w-full">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Rechercher un produit..."
                            class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <!-- Menu Mobile -->
    <div class="mobile-menu md:hidden hidden mt-2 bg-white rounded-lg shadow-lg py-4 px-6 absolute left-0 right-0 z-40">
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('home') }}"
                class="text-black font-bold hover:text-primary-600 transition {{ request()->routeIs('home') ? 'text-primary font-bold' : '' }}">ACCUEIL</a>
            <a href="{{ route('products.index') }}"
                class="text-black font-bold hover:text-primary-600 transition {{ request()->routeIs('products.*') ? 'text-primary font-bold' : '' }}">BOUTIQUE</a>
            <a href="{{ route('blogs.index') }}"
                class="text-black font-bold hover:text-primary-600 transition {{ request()->routeIs('blogs.*') ? 'text-primary font-bold' : '' }}">BLOG</a>
            {{-- <a href="{{ route('cart.index') }}"
               class="text-black font-bold hover:text-primary-600 transition {{ request()->routeIs('cart.*') ? 'text-primary font-bold' : '' }}">VOTRE PANNIER</a> --}}
        </nav>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ecom-App</h3>
                    <p class="text-gray-300">Votre boutique en ligne de confiance pour des produits de qualité.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-orange-500">Liens Rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-300 hover:text-white transition">Accueil</a>
                        </li>
                        <li><a href="{{ route('products.index') }}"
                                class="text-gray-300 hover:text-white transition">Boutique</a></li>
                        <li><a href="{{ route('blogs.index') }}"
                                class="text-gray-300 hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-orange-500">Contact</h3>
                    <p class="text-gray-300">Email: contact@ecom-app.tg</p>
                    <p class="text-gray-300">Téléphone: +228 XX XX XX XX</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2025 Ecom-App. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        // Mobile Menu Toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
            document.querySelector('.mobile-search').classList.add('hidden');
        });

        // Toggle Recherche Mobile
        document.querySelector('.mobile-search-button')?.addEventListener('click', function() {
            document.querySelector('.mobile-search').classList.toggle('hidden');
            document.querySelector('.mobile-menu').classList.add('hidden');
        });

        // Update cart count on page load
        function updateCartCount() {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.cart-count').textContent = data.total_items;
                });
        }

        // Initialize cart count
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>

    @stack('scripts')
</body>

</html>
