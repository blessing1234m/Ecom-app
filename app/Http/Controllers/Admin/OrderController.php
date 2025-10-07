<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with('items.product');

        // Filtre par statut
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->latest()->paginate(15);

        $orderStats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'orderStats'));
    }

    public function show(Order $order): View
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut de la commande mis à jour avec succès!');
    }

    public function edit(Order $order): View
    {
        $order->load('items.product');
        $products = \App\Models\Product::where('is_active', true)->get();
        return view('admin.orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string|max:255',
            // Ajoute d'autres validations si tu veux modifier les produits
        ]);

        $order->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            // Ajoute d'autres champs si nécessaire
        ]);

        // Mise à jour des articles existants
        if ($request->has('items')) {
            foreach ($request->items as $itemId => $data) {
                $orderItem = $order->items()->find($itemId);
                if ($orderItem) {
                    $orderItem->update([
                        'product_id' => $data['product_id'],
                        'quantity' => $data['quantity'],
                    ]);
                }
            }
        }

        // Ajout d'un nouvel article
        if ($request->filled('new_product_id') && $request->filled('new_quantity')) {
            $order->items()->create([
                'product_id' => $request->new_product_id,
                'quantity' => $request->new_quantity,
            ]);
        }

        // Suppression d'un article (optionnel, à gérer côté JS ou via une case à cocher)

        return redirect()->route('admin.orders.show', $order)->with('success', 'Commande modifiée avec succès!');
    }
}
