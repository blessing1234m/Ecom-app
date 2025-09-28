<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
public function checkout(): View
    {
        $cartService = app(\App\Services\CartService::class);
        $cartItems = $cartService->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = $cartService->getTotal();

        return view('front.orders.checkout', compact('cartItems', 'total'));
    }
public function store(Request $request): RedirectResponse
{
    $cartService = app(\App\Services\CartService::class);
    $cartItems = $cartService->getCartItems();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
    }

    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'nullable|email|max:255',
        'customer_phone' => 'required|string|max:20',
        'customer_address' => 'required|string|max:500',
        'notes' => 'nullable|string|max:1000',
    ]);

    // Calculate totals
    $subtotal = $cartService->getTotal();
    $shipping = 0; // Free shipping for now
    $totalAmount = $subtotal + $shipping;

    // Create order
    $order = Order::create([
        'customer_name' => $validated['customer_name'],
        'customer_email' => $validated['customer_email'],
        'customer_phone' => $validated['customer_phone'],
        'customer_address' => $validated['customer_address'],
        'notes' => $validated['notes'],
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total_amount' => $totalAmount,
        'status' => 'pending',
    ]);

    // Create order items and update product stock
    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['price'],
            'total_price' => $item['total'],
        ]);

        // Update product stock
        $product = Product::find($item['id']);
        if ($product) {
            $product->decrement('stock', $item['quantity']);
        }
    }

    // Clear cart
    $cartService->clearCart();

    return redirect()->route('orders.confirmation', $order->id)
                     ->with('success', 'Votre commande a été passée avec succès!');
}

    public function confirmation(Order $order): View
    {
        if ($order->status === 'cancelled') {
            abort(404);
        }

        return view('front.orders.confirmation', compact('order'));
    }

    public function show(Order $order): View
    {
        return view('front.orders.show', compact('order'));
    }

    private function getCartItems()
    {
        $cart = json_decode(request()->cookie('ecom-cart'), true) ?? [];

        if (empty($cart)) {
            // Try to get from localStorage via request parameter
            $cart = json_decode(request()->input('cart_data', '[]'), true);
        }

        if (empty($cart)) {
            return collect();
        }

        $productIds = collect($cart)->pluck('id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        return collect($cart)->map(function ($item) use ($products) {
            $product = $products->get($item['id']);

            if (!$product) {
                return null;
            }

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity'],
                'slug' => $product->slug,
                'stock' => $product->stock
            ];
        })->filter();
    }

    private function calculateTotal($cartItems)
    {
        return $cartItems->sum('total');
    }

    private function clearCart()
    {
        // Clear localStorage via JavaScript will be handled in the view
        // We can also clear the cookie if we were using it
        cookie()->queue(cookie()->forget('ecom-cart'));
    }
}
