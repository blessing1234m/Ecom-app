{{-- filepath: resources/views/admin/orders/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier la commande - Admin Ecom-App')
@section('page_title', 'Modifier la commande')

@section('content')
    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Nom du client</label>
            <input type="text" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Téléphone</label>
            <input type="text" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Adresse</label>
            <input type="text" name="customer_address" value="{{ old('customer_address', $order->customer_address) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        {{-- infos client --}}

        <div class="mb-6">
            <h4 class="font-semibold mb-2">Articles de la commande</h4>
            @foreach($order->items as $item)
                <div class="flex items-center gap-2 mb-2">
                    <select name="items[{{ $item->id }}][product_id]" class="border rounded px-2 py-1">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}"
                           min="1" class="w-20 border rounded px-2 py-1">
                    <button type="button" class="text-red-600 remove-item" data-id="{{ $item->id }}">Supprimer</button>
                </div>
            @endforeach
        </div>

        {{-- Option pour ajouter un nouvel article --}}
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Ajouter un produit</h4>
            <div class="flex items-center gap-2">
                <select name="new_product_id" class="border rounded px-2 py-1">
                    <option value="">-- Choisir un produit --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="new_quantity" value="1" min="1" class="w-20 border rounded px-2 py-1">
            </div>
        </div>

        <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-700 transition">
            Mettre à jour
        </button>
    </form>
@endsection
