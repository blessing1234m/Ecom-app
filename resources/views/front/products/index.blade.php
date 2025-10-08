@extends('layouts.app')

@section('title', 'Produits - Ecom-App')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Filtres</h3>

                <!-- Search -->
                <div class="mb-6">
                    <form action="{{ route('products.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Rechercher..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </form>
                </div>

                <!-- Categories -->
                <div class="mb-6">
                    <h4 class="font-medium mb-3">Catégories</h4>
                    <div class="space-y-2">
                        <a href="{{ route('products.index') }}"
                           class="block text-gray-600 hover:text-primary-600 transition {{ !request('category') ? 'text-primary-600 font-medium' : '' }}">
                            Toutes les catégories
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="block text-gray-600 hover:text-primary-600 transition {{ request('category') == $category->slug ? 'text-primary-600 font-medium' : '' }}">
                            {{ $category->name }} ({{ $category->products_count }})
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-6">
                    <h4 class="font-medium mb-3">Prix</h4>
                    <form action="{{ route('products.index') }}" method="GET">
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <div class="flex gap-2 mb-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                   placeholder="Min" class="w-1/2 px-2 py-1 border border-gray-300 rounded text-sm">
                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                   placeholder="Max" class="w-1/2 px-2 py-1 border border-gray-300 rounded text-sm">
                        </div>
                        <button type="submit" class="w-full bg-primary-500 text-white py-2 rounded hover:bg-primary-600 transition text-sm">
                            Appliquer
                        </button>
                    </form>
                </div>

                <!-- Clear Filters -->
                @if(request()->anyFilled(['category', 'search', 'min_price', 'max_price']))
                <a href="{{ route('products.index') }}" class="block text-center text-gray-600 hover:text-primary-600 transition text-sm">
                    Effacer les filtres
                </a>
                @endif
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:w-3/4">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Nos Produits</h1>
                    <p class="text-gray-600">{{ $products->total() }} produit(s) trouvé(s)</p>
                </div>

                <!-- Sort -->
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2">
                    @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="sort" onchange="this.form.submit()"
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Nouveautés</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                    </select>
                </form>
            </div>

            <!-- Products -->
            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="relative">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                     class="h-full w-full object-cover hover:scale-105 transition duration-300">
                                @else
                                <span class="text-gray-500">Image non disponible</span>
                                @endif
                            </div>
                        </a>
                        @if($product->has_discount)
                        <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded">
                            -{{ $product->discount_percentage }}%
                        </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="mb-2">
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $product->category->name }}</span>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-primary-600 transition">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-primary-600 font-bold">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                @if($product->has_discount)
                                <span class="text-gray-400 text-sm line-through">{{ number_format($product->compare_price, 0, ',', ' ') }} FCFA</span>
                                @endif
                            </div>
                            <button class="add-to-cart bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600 transition"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->price }}"
                                    data-product-image="{{ $product->image }}">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit trouvé</h3>
                <p class="text-gray-500 mb-4">Essayez de modifier vos critères de recherche.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-primary-500 text-white px-6 py-2 rounded hover:bg-primary-600 transition">
                    Voir tous les produits
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
            });
        });
    });

    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-blue-500'
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
