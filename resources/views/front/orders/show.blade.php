@extends('layouts.app')

@section('title', 'Commande ' . $order->order_number . ' - Ecom-App')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Commande {{ $order->order_number }}</h1>
            <p class="text-gray-600 mt-2">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Statut de la commande</h2>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_color }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-primary-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Articles</h2>

                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between py-4 border-b border-gray-200 last:border-b-0">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                        @if($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}"
                                             class="h-full w-full object-cover rounded">
                                        @else
                                        <span class="text-gray-400 text-xs">No image</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-gray-500">Quantité: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-500">{{ number_format($item->unit_price, 0, ',', ' ') }} FCFA × {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-medium text-gray-900">{{ number_format($item->total_price, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Informations client</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nom</dt>
                            <dd class="text-sm text-gray-900">{{ $order->customer_name }}</dd>
                        </div>
                        @if($order->customer_email)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $order->customer_email }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                            <dd class="text-sm text-gray-900">{{ $order->customer_phone }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                            <dd class="text-sm text-gray-900">{{ $order->customer_address }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Résumé</h3>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Sous-total</dt>
                            <dd class="text-gray-900">{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Livraison</dt>
                            <dd class="text-gray-900">{{ number_format($order->shipping, 0, ',', ' ') }} FCFA</dd>
                        </div>
                        <div class="border-t border-gray-200 pt-2 mt-2">
                            <div class="flex justify-between text-lg font-semibold">
                                <dt>Total</dt>
                                <dd class="text-primary-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</dd>
                            </div>
                        </div>
                    </dl>
                </div>

                <!-- Notes -->
                @if($order->notes)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Notes</h3>
                    <p class="text-gray-600 text-sm">{{ $order->notes }}</p>
                </div>
                @endif

                <!-- Help -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-blue-900 mb-2">Besoin d'aide ?</h4>
                    <p class="text-sm text-blue-700">
                        Contactez-nous au <strong>+228 XX XX XX XX</strong> pour toute question concernant votre commande.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
