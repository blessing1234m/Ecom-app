@extends('layouts.admin')

@section('title', 'Gestion des Commandes - Admin Ecom-App')
@section('page_title', 'Gestion des Commandes')

@section('breadcrumb')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                Tableau de bord
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Commandes</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<!-- Statistiques des commandes -->
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow text-center">
        <div class="text-2xl font-bold text-gray-900">{{ $orderStats['total'] }}</div>
        <div class="text-sm text-gray-500">Total</div>
    </div>
    <div class="bg-yellow-50 p-4 rounded-lg shadow text-center border border-yellow-200">
        <div class="text-2xl font-bold text-yellow-700">{{ $orderStats['pending'] }}</div>
        <div class="text-sm text-yellow-600">En attente</div>
    </div>
    <div class="bg-blue-50 p-4 rounded-lg shadow text-center border border-blue-200">
        <div class="text-2xl font-bold text-blue-700">{{ $orderStats['confirmed'] }}</div>
        <div class="text-sm text-blue-600">Confirmées</div>
    </div>
    {{-- <div class="bg-indigo-50 p-4 rounded-lg shadow text-center border border-indigo-200">
        <div class="text-2xl font-bold text-indigo-700">{{ $orderStats['processing'] }}</div>
        <div class="text-sm text-indigo-600">En traitement</div>
    </div> --}}
    <div class="bg-purple-50 p-4 rounded-lg shadow text-center border border-purple-200">
        <div class="text-2xl font-bold text-purple-700">{{ $orderStats['shipped'] }}</div>
        <div class="text-sm text-purple-600">Expédiées</div>
    </div>
    <div class="bg-green-50 p-4 rounded-lg shadow text-center border border-green-200">
        <div class="text-2xl font-bold text-green-700">{{ $orderStats['delivered'] }}</div>
        <div class="text-sm text-green-600">Livrées</div>
    </div>
    <div class="bg-red-50 p-4 rounded-lg shadow text-center border border-red-200">
        <div class="text-2xl font-bold text-red-700">{{ $orderStats['cancelled'] }}</div>
        <div class="text-sm text-red-600">Annulées</div>
    </div>
</div>

<!-- Filtres et Recherche -->
<div class="bg-white shadow rounded-lg mb-6">
    <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Recherche -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                <input type="text"
                       name="search"
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="N° commande, client, téléphone..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>

            <!-- Statut -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select name="status"
                        id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Tous les statuts</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>En traitement</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Livrée</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="flex items-end space-x-2">
                <button type="submit"
                        class="flex-1 bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition">
                    Filtrer
                </button>
                <a href="{{ route('admin.orders.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Tableau des commandes -->
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Commande
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Client
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Téléphone
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $order->order_number }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $order->items->count() }} article(s)
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $order->customer_name }}
                        </div>
                        @if($order->customer_email)
                        <div class="text-sm text-gray-500">
                            {{ $order->customer_email }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $order->customer_phone }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="text-xs font-medium rounded-full px-3 py-1 border-0 focus:ring-2 focus:ring-primary-500 {{ $order->status_color }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                {{-- <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En traitement</option> --}}
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livrée</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $order->created_at->format('d/m/Y') }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $order->created_at->format('H:i') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="text-primary-600 hover:text-primary-900 transition inline-flex items-center"
                           title="Voir les détails">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Détails
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        Aucune commande trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
