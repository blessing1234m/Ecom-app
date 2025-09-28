@extends('layouts.app')

@section('title', 'Confirmation de commande - Ecom-App')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Success Icon -->
        <div class="mb-6">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Commande confirmée !</h1>
        <p class="text-lg text-gray-600 mb-8">
            Merci pour votre commande. Nous vous contacterons bientôt pour confirmer la livraison.
        </p>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 text-left">
            <h2 class="text-xl font-semibold mb-4">Détails de la commande</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Informations de commande</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Numéro de commande:</dt>
                            <dd class="font-medium">{{ $order->order_number }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Date:</dt>
                            <dd class="font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Statut:</dt>
                            <dd class="font-medium">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_color }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Total:</dt>
                            <dd class="font-medium text-primary-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Informations de livraison</h3>
                    <dl class="space-y-2 text-sm">
                        <div>
                            <dt class="text-gray-600">Nom:</dt>
                            <dd class="font-medium">{{ $order->customer_name }}</dd>
                        </div>
                        @if($order->customer_email)
                        <div>
                            <dt class="text-gray-600">Email:</dt>
                            <dd class="font-medium">{{ $order->customer_email }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-gray-600">Téléphone:</dt>
                            <dd class="font-medium">{{ $order->customer_phone }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600">Adresse:</dt>
                            <dd class="font-medium">{{ $order->customer_address }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            @if($order->notes)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <h3 class="font-medium text-gray-900 mb-2">Notes supplémentaires</h3>
                <p class="text-sm text-gray-600">{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Articles commandés</h2>

            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-3 border-b border-gray-200 last:border-b-0">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                                @if($item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}"
                                     class="h-full w-full object-cover rounded">
                                @else
                                <span class="text-gray-400 text-xs">No image</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-left">
                            <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">Quantité: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ number_format($item->total_price, 0, ',', ' ') }} FCFA</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Totals -->
            <div class="border-t border-gray-200 pt-4 mt-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Sous-total</span>
                    <span class="text-gray-900">{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Livraison</span>
                    <span class="text-gray-900">{{ number_format($order->shipping, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="flex justify-between text-lg font-semibold border-t border-gray-200 pt-2">
                    <span>Total</span>
                    <span class="text-primary-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-medium text-blue-900 mb-3">Prochaines étapes</h3>
            <ul class="text-left text-blue-800 space-y-2">
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Vous recevrez un appel téléphonique pour confirmer votre commande
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Livraison à l'adresse fournie avec paiement en espèces
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Temps de livraison estimé: 1-3 jours ouvrables
                </li>
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition">
                Continuer vos achats
            </a>
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                Retour à l'accueil
            </a>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>Des questions concernant votre commande ?</p>
            <p class="mt-1">Contactez-nous au <strong>+228 XX XX XX XX</strong> ou <strong>contact@ecom-app.tg</strong></p>
        </div>
    </div>
</div>
@endsection
