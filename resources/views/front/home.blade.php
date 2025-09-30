@extends('layouts.app')

@section('title', 'Accueil - Ecom-App')

@section('content')
    <!-- Bannière Slideshow centrée et limitée en largeur -->
    <section class="relative h-[500px] overflow-hidden max-w-7xl mx-auto my-8 rounded-xl shadow-lg border-4 border-orange-500">
        <div class="swiper banner-swiper h-full">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide h-[500px] relative">
                        @if ($banner->image)
                            <img src="{{ Storage::url($banner->image) }}"
                                 alt="{{ $banner->title }}"
                                 class="absolute inset-0 w-full h-full object-cover object-center z-0" />
                        @else
                            <div class="absolute inset-0 bg-gray-200"></div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center z-20 px-4">
                            <div class="text-center text-white max-w-2xl mx-auto">
                                <h1 class="text-4xl font-bold mb-4">{{ $banner->title }}</h1>
                                <p class="text-lg mb-6">{{ $banner->description }}</p>
                                @if ($banner->button_text)
                                    <a href="{{ $banner->button_link }}"
                                       class="inline-block bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition mx-auto">
                                        {{ $banner->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Catégories -->
    <section class="container mx-auto px-4 py-12">
        {{-- <h2 class="text-3xl font-bold text-center mb-8 ">Catégories</h2> --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition group">
                    <div class="h-32 bg-gray-200 flex items-center justify-center group-hover:bg-gray-300 transition">
                        @if ($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                class="h-full w-full object-cover">
                        @else
                            <span class="text-gray-500">{{ $category->name }}</span>
                        @endif
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $category->products_count }} produits</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Produits Populaires -->
    <section class="container mx-auto px-4 py-12 bg-gray-50">
        <h2 class="text-3xl font-bold text-center mb-8">Produits Populaires</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="relative">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover">
                            @else
                                <span class="text-gray-500">Image non disponible</span>
                            @endif
                        </div>
                        @if ($product->has_discount)
                            <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="hover:text-primary-600 transition">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-primary-600 font-bold">{{ number_format($product->price, 0, ',', ' ') }}
                                    FCFA</span>
                                @if ($product->has_discount)
                                    <span
                                        class="text-gray-400 text-sm line-through">{{ number_format($product->compare_price, 0, ',', ' ') }}
                                        FCFA</span>
                                @endif
                            </div>
                            @include('components.add-to-cart-button', [
                                'productId' => $product->id,
                                'class' =>
                                    'bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600 transition',
                                'text' => 'Ajouter',
                            ])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('products.index') }}"
                class="inline-block bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                Voir tous les produits
            </a>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // Swiper initialization for the banner
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.banner-swiper', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
            });
        });

        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;

                fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount();
                            showNotification('Produit ajouté au panier !', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Erreur lors de l\'ajout au panier', 'error');
                    });
            });
        });

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
@endpush
