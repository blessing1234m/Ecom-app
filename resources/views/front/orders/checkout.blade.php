@extends('layouts.app')

@section('title', 'Checkout - Ecom-App')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Finaliser la commande</h1>

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Checkout Form -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-6">Informations de livraison</h2>

                <form action="{{ route('orders.store') }}" method="POST" id="checkoutForm">
                    @csrf

                    <!-- Customer Name -->
                    <div class="mb-4">
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom complet *
                        </label>
                        <input type="text"
                               id="customer_name"
                               name="customer_name"
                               value="{{ old('customer_name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               required>
                        @error('customer_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Email -->
                    <div class="mb-4">
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email"
                               id="customer_email"
                               name="customer_email"
                               value="{{ old('customer_email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        @error('customer_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Phone -->
                    <div class="mb-4">
                        <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Téléphone *
                        </label>
                        <input type="tel"
                               id="customer_phone"
                               name="customer_phone"
                               value="{{ old('customer_phone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               required>
                        @error('customer_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Address -->
                    <div class="mb-4">
                        <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse de livraison *
                        </label>
                        <textarea
                            id="customer_address"
                            name="customer_address"
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="Veuillez fournir votre adresse complète pour la livraison..."
                            required>{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes supplémentaires (optionnel)
                        </label>
                        <textarea
                            id="notes"
                            name="notes"
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="Instructions spéciales pour la livraison...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Méthode de paiement</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="cash_on_delivery" name="payment_method" type="radio" value="cash_on_delivery" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300" checked>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="cash_on_delivery" class="font-medium text-gray-700">Paiement à la livraison (Espèces)</label>
                                    <p class="text-gray-500">Payez lorsque vous recevez votre commande</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-primary-500 text-white py-3 px-6 rounded-lg hover:bg-primary-600 transition font-semibold text-lg">
                        Confirmer la commande
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-semibold mb-6">Résumé de la commande</h2>

                <!-- Cart Items -->
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                @if($item['image'])
                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}"
                                     class="h-full w-full object-cover rounded">
                                @else
                                <span class="text-gray-400 text-xs">No image</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-500">Quantité: {{ $item['quantity'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ number_format($item['total'], 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Totals -->
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sous-total</span>
                        <span class="text-gray-900">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Livraison</span>
                        <span class="text-gray-900">0 FCFA</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold border-t border-gray-200 pt-2">
                        <span>Total</span>
                        <span class="text-primary-600">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>

                <!-- Return to Cart -->
                <div class="mt-6">
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Modifier le panier
                    </a>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Paiement sécurisé</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Vos informations sont sécurisées. Paiement en espèces à la livraison uniquement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Form validation
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    });

    // Real-time validation
    document.querySelectorAll('#checkoutForm [required]').forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.add('border-red-500');
            } else {
                this.classList.remove('border-red-500');
            }
        });
    });
</script>
@endpush
