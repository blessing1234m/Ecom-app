<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): View
    {
        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();

        return view('front.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $this->cartService->addToCart($request->product_id, $request->quantity);

        return response()->json([
            'success' => true,
            'total_items' => $this->cartService->getTotalItems(),
            'message' => 'Produit ajouté au panier'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $this->cartService->updateQuantity($request->product_id, $request->quantity);

        return response()->json([
            'success' => true,
            'total_items' => $this->cartService->getTotalItems(),
            'message' => 'Panier mis à jour'
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $this->cartService->removeFromCart($request->product_id);

        return response()->json([
            'success' => true,
            'total_items' => $this->cartService->getTotalItems(),
            'message' => 'Produit retiré du panier'
        ]);
    }

    public function getCartCount()
    {
        return response()->json([
            'total_items' => $this->cartService->getTotalItems()
        ]);
    }
}
