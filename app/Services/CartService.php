<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey = 'ecom-cart';

    public function getCart()
    {
        return Session::get($this->sessionKey, []);
    }

public function addToCart($productId, $quantity = 1)
{
    $cart = $this->getCart();

    // Vérifier si le produit existe
    $product = Product::find($productId);
    if (!$product) {
        return $cart;
    }

    // Vérifier le stock
    $currentQuantity = $cart[$productId] ?? 0;
    $newQuantity = $currentQuantity + $quantity;

    if ($newQuantity > $product->stock) {
        $newQuantity = $product->stock;
    }

    $cart[$productId] = $newQuantity;

    Session::put($this->sessionKey, $cart);
    return $cart;
}

    public function updateQuantity($productId, $quantity)
    {
        $cart = $this->getCart();

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put($this->sessionKey, $cart);
        return $cart;
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        Session::put($this->sessionKey, $cart);
        return $cart;
    }

    public function clearCart()
    {
        Session::forget($this->sessionKey);
    }

    public function getCartItems()
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return collect();
        }

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $items = collect();
        foreach ($cart as $productId => $quantity) {
            $product = $products->get($productId);

            if ($product) {
                $items->push([
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity,
                    'slug' => $product->slug,
                    'stock' => $product->stock
                ]);
            }
        }

        return $items;
    }

    public function getTotal()
    {
        return $this->getCartItems()->sum('total');
    }

    public function getTotalItems()
    {
        return array_sum($this->getCart());
    }
}
