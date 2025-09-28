@extends('layouts.app')

@section('title', 'Panier - Ecom-App')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Votre Panier</h1>

        @if ($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Cart Header -->
                        <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <div class="col-span-6">
                                <span class="font-semibold text-gray-700">Produit</span>
                            </div>
                            <div class="col-span-2 text-center">
                                <span class="font-semibold text-gray-700">Prix</span>
                            </div>
                            <div class="col-span-2 text-center">
                                <span class="font-semibold text-gray-700">Quantité</span>
                            </div>
                            <div class="col-span-2 text-center">
                                <span class="font-semibold text-gray-700">Total</span>
                            </div>
                        </div>

                        <!-- Cart Items -->
                        <div class="divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <div class="p-6">
                                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                                        <!-- Product Image & Name -->
                                        <div class="flex items-center space-x-4 md:w-6/12">
                                            <a href="{{ route('products.show', $item['slug']) }}" class="flex-shrink-0">
                                                <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                    @if ($item['image'])
                                                        <img src="{{ Storage::url($item['image']) }}"
                                                            alt="{{ $item['name'] }}"
                                                            class="h-full w-full object-cover rounded">
                                                    @else
                                                        <span class="text-gray-400 text-xs">No image</span>
                                                    @endif
                                                </div>
                                            </a>
                                            <div>
                                                <a href="{{ route('products.show', $item['slug']) }}"
                                                    class="font-medium text-gray-900 hover:text-primary-600 transition">
                                                    {{ $item['name'] }}
                                                </a>
                                                <div class="md:hidden mt-2">
                                                    <span
                                                        class="text-primary-600 font-bold">{{ number_format($item['price'], 0, ',', ' ') }}
                                                        FCFA</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Price (Desktop) -->
                                        <div class="hidden md:block md:w-2/12 text-center">
                                            <span
                                                class="text-primary-600 font-bold">{{ number_format($item['price'], 0, ',', ' ') }}
                                                FCFA</span>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="flex items-center justify-between md:justify-center md:w-2/12">
                                            <div class="flex items-center border border-gray-300 rounded">
                                                <button type="button"
                                                    class="decrease-quantity px-3 py-1 text-gray-600 hover:text-gray-700"
                                                    data-product-id="{{ $item['id'] }}">-</button>
                                                <span
                                                    class="w-12 py-1 text-center border-0 quantity-display">{{ $item['quantity'] }}</span>
                                                <button type="button"
                                                    class="increase-quantity px-3 py-1 text-gray-600 hover:text-gray-700"
                                                    data-product-id="{{ $item['id'] }}">+</button>
                                            </div>
                                        </div>

                                        <!-- Total & Remove -->
                                        <div class="flex items-center justify-between md:justify-center md:w-2/12">
                                            <div class="text-right md:text-center">
                                                <span
                                                    class="font-bold text-gray-900">{{ number_format($item['total'], 0, ',', ' ') }}
                                                    FCFA</span>
                                            </div>
                                            <button type="button"
                                                class="remove-item text-red-600 hover:text-red-800 transition ml-4"
                                                data-product-id="{{ $item['id'] }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Continue Shopping -->
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center text-primary-600 hover:text-primary-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Continuer vos achats
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h3 class="text-lg font-semibold mb-4">Résumé de la commande</h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-medium">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Livraison</span>
                                <span class="font-medium">0 FCFA</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold">Total</span>
                                    <span
                                        class="text-lg font-bold text-primary-600">{{ number_format($total, 0, ',', ' ') }}
                                        FCFA</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}"
                            class="w-full bg-primary-500 text-white py-3 px-6 rounded-lg hover:bg-primary-600 transition font-semibold text-center block">
                            Passer la commande
                        </a>

                        <p class="text-xs text-gray-500 mt-4 text-center">
                            Paiement à la livraison en espèces
                        </p>

                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-medium text-gray-900 mb-4">Votre panier est vide</h3>
                <p class="text-gray-500 mb-8">Découvrez nos produits et ajoutez-les à votre panier.</p>
                <a href="{{ route('products.index') }}"
                    class="inline-block bg-primary-500 text-white px-8 py-3 rounded-lg hover:bg-primary-600 transition font-semibold">
                    Commencer vos achats
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Update quantity
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const display = this.nextElementSibling;
                const currentQuantity = parseInt(display.textContent);

                if (currentQuantity > 1) {
                    updateCartItem(productId, currentQuantity - 1);
                }
            });
        });

        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const display = this.previousElementSibling;
                const currentQuantity = parseInt(display.textContent);

                updateCartItem(productId, currentQuantity + 1);
            });
        });

        // Remove item
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;

                if (confirm('Êtes-vous sûr de vouloir supprimer ce produit du panier ?')) {
                    removeCartItem(productId);
                }
            });
        });

        function updateCartItem(productId, quantity) {
            fetch('{{ route('cart.update') }}', {
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
                        // Reload page to update totals
                        window.location.reload();
                    }
                });
        }

        function removeCartItem(productId) {
            fetch('{{ route('cart.remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartCount();
                        // Reload page to update the view
                        window.location.reload();
                    }
                });
        }
    </script>
@endpush
