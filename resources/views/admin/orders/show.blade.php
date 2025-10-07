@extends('layouts.admin')

@section('title', 'Commande ' . $order->order_number . ' - Admin Ecom-App')
@section('page_title', 'Commande ' . $order->order_number)

@section('breadcrumb')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                    Tableau de bord
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('admin.orders.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ml-2">Commandes</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $order->order_number }}</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Détails de la commande -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Statut et Actions -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Statut de la commande</h3>
                        <p class="text-sm text-gray-500">Mis à jour le {{ $order->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4 ml-auto">
                        {{-- <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En traitement</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livrée</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            <button type="submit"
                                    class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition">
                                Changer Statut
                            </button>
                        </form> --}}
                        <a href="{{ route('admin.orders.edit', $order) }}"
                           class="px-5 py-2 bg-primary-600 text-white rounded hover:bg-primary-700 transition">
                            Modifier la commande
                        </a>
                    </div>
                </div>
            </div>

            <!-- Articles de la commande -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Articles commandés</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex items-center justify-between py-4 border-b border-gray-200 last:border-b-0">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                            @if ($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="h-full w-full object-cover rounded">
                                            @else
                                                <span class="text-gray-400 text-xs">No image</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">Quantité: {{ $item->quantity }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ number_format($item->unit_price, 0, ',', ' ') }} FCFA ×
                                            {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ number_format($item->total_price, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Informations de livraison -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Informations de livraison</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nom complet</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $order->customer_name }}</dd>
                        </div>
                        @if ($order->customer_email)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $order->customer_email }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $order->customer_phone }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Adresse de livraison</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $order->customer_address }}</dd>
                        </div>
                        @if ($order->notes)
                            <div class="md:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Notes supplémentaires</dt>
                                <dd class="text-sm text-gray-900 mt-1">{{ $order->notes }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        <!-- Résumé et Informations -->
        <div class="space-y-6">
            <!-- Résumé de la commande -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Résumé de la commande</h3>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-600">Sous-total</dt>
                        <dd class="text-sm text-gray-900">{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-600">Livraison</dt>
                        <dd class="text-sm text-gray-900">{{ number_format($order->shipping, 0, ',', ' ') }} FCFA</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-2">
                        <div class="flex justify-between text-lg font-semibold">
                            <dt>Total</dt>
                            <dd class="text-primary-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</dd>
                        </div>
                    </div>
                </dl>
            </div>

            <!-- Informations de la commande -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informations</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Numéro de commande</dt>
                        <dd class="text-sm text-gray-900">{{ $order->order_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Date de commande</dt>
                        <dd class="text-sm text-gray-900">{{ $order->created_at->format('d/m/Y à H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dernière mise à jour</dt>
                        <dd class="text-sm text-gray-900">{{ $order->updated_at->format('d/m/Y à H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Statut actuel</dt>
                        <dd class="text-sm">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_color }}">
                                @switch($order->status)
                                    @case('pending')
                                        En attente
                                    @break

                                    @case('confirmed')
                                        Confirmée
                                    @break

                                    @case('processing')
                                        En traitement
                                    @break

                                    @case('shipped')
                                        Expédiée
                                    @break

                                    @case('delivered')
                                        Livrée
                                    @break

                                    @case('cancelled')
                                        Annulée
                                    @break
                                @endswitch
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
