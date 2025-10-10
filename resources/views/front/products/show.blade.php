@extends('layouts.app')

@section('title', $product->name . ' - Ecom-App')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm text-gray-700 hover:text-primary-600">
                        Accueil
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('products.index') }}"
                            class="ml-1 text-sm text-gray-700 hover:text-primary-600 md:ml-2">Produits</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                            class="ml-1 text-sm text-gray-700 hover:text-primary-600 md:ml-2">{{ $product->category->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-500 md:ml-2">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Product Images -->
            <div>
                <!-- Main Image -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                    <div class="h-96 flex items-center justify-center bg-gray-100">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                class="h-full w-full object-cover" id="mainImage">
                        @else
                            <span class="text-gray-500">Image non disponible</span>
                        @endif
                    </div>
                </div>

                <!-- Gallery -->
                @if ($product->gallery && count($product->gallery) > 0)
                    <div class="grid grid-cols-4 gap-2">
                        <div class="cursor-pointer border-2 border-primary-500 rounded gallery-thumb-wrapper active-thumb">
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                class="h-20 w-full object-cover gallery-thumb"
                                data-img="{{ Storage::url($product->image) }}">
                        </div>
                        @foreach ($product->gallery as $image)
                            <div class="cursor-pointer border border-gray-200 rounded hover:border-primary-500 transition gallery-thumb-wrapper">
                                <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}"
                                    class="h-20 w-full object-cover gallery-thumb"
                                    data-img="{{ Storage::url($image) }}">
                            </div>
                        @endforeach
                    </div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.gallery-thumb').forEach(function(thumb) {
            thumb.addEventListener('click', function() {
                var main = document.getElementById('mainImage');
                if(main && this.dataset.img) {
                    main.src = this.dataset.img;
                }
                // Gestion du contour bleu
                document.querySelectorAll('.gallery-thumb-wrapper').forEach(function(wrapper) {
                    wrapper.classList.remove('border-2', 'border-primary-500', 'active-thumb');
                    wrapper.classList.add('border', 'border-gray-200');
                });
                var parent = this.closest('.gallery-thumb-wrapper');
                if(parent) {
                    parent.classList.remove('border', 'border-gray-200');
                    parent.classList.add('border-2', 'border-primary-500', 'active-thumb');
                }
            });
        });
    });
</script>
@endpush
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    @if ($product->has_discount)
                        <span class="inline-block bg-red-500 text-white px-3 py-1 text-sm rounded-full mb-3">
                            -{{ $product->discount_percentage }}%
                        </span>
                    @endif

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    <!-- Price -->
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="text-2xl font-bold text-primary-600">{{ number_format($product->price, 0, ',', ' ') }}
                            FCFA</span>
                        @if ($product->has_discount)
                            <span
                                class="text-lg text-gray-500 line-through">{{ number_format($product->compare_price, 0, ',', ' ') }}
                                FCFA</span>
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="mb-6">
                        @if ($product->stock > 0)
                            <span class="inline-flex items-center text-sm text-green-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                En stock ({{ $product->stock }} disponible(s))
                            </span>
                        @else
                            <span class="inline-flex items-center text-sm text-red-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Rupture de stock
                            </span>
                        @endif
                    </div>

                    <!-- Add to Cart -->
                    <div class="mb-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                            <div class="flex items-center border border-gray-300 rounded">
                                <button type="button"
                                    class="decrease-quantity px-3 py-2 text-gray-600 hover:text-gray-700">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1"
                                    max="{{ $product->stock }}"
                                    class="w-16 py-2 text-center border-0 focus:ring-0 focus:outline-none">
                                <button type="button"
                                    class="increase-quantity px-3 py-2 text-gray-600 hover:text-gray-700">+</button>
                            </div>
                        </div>

                        <button id="addToCartBtn"
                            class="w-full bg-primary-500 text-white py-3 px-6 rounded-lg hover:bg-primary-600 transition font-semibold disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $product->stock <= 0 ? 'disabled' : '' }} data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}"
                            data-product-image="{{ $product->image }}">
                            {{ $product->stock > 0 ? 'Ajouter au panier' : 'Rupture de stock' }}
                        </button>
                    </div>

                    <!-- Category -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <span class="font-medium mr-2">Catégorie:</span>
                            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                                class="text-primary-600 hover:text-primary-700">
                                {{ $product->category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Description du produit</h2>
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>
        </div>

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Produits similaires</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="relative">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                                        @if ($relatedProduct->image)
                                            <img src="{{ Storage::url($relatedProduct->image) }}"
                                                alt="{{ $relatedProduct->name }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-gray-500">Image non disponible</span>
                                        @endif
                                    </div>
                                </a>
                                @if ($relatedProduct->has_discount)
                                    <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded">
                                        -{{ $relatedProduct->discount_percentage }}%
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                        class="hover:text-primary-600 transition">
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h3>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                        <span
                                            class="text-primary-600 font-bold">{{ number_format($relatedProduct->price, 0, ',', ' ') }}
                                            FCFA</span>
                                        @if ($relatedProduct->has_discount)
                                            <span
                                                class="text-gray-400 text-sm line-through">{{ number_format($relatedProduct->compare_price, 0, ',', ' ') }}
                                                FCFA</span>
                                        @endif
                                    </div>
                                    <button id="addToCartBtn"
                                        class="w-full bg-primary-500 text-white py-3 px-6 rounded-lg hover:bg-primary-600 transition font-semibold disabled:opacity-50 disabled:cursor-not-allowed"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}
                                        data-product-id="{{ $product->id }}">
                                        {{ $product->stock > 0 ? 'Ajouter au panier' : 'Rupture de stock' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Add to cart from detail page
    document.getElementById('addToCartBtn').addEventListener('click', function() {
        const quantity = parseInt(document.getElementById('quantity').value);
        const productId = this.dataset.productId;

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
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

    // Add to cart for related products
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;

            fetch('{{ route("cart.add") }}', {
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

    function updateCartCount() {
        fetch('{{ route("cart.count") }}')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = data.total_items;
                }
            });
    }

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
