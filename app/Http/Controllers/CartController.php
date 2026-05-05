<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller {

    public function index() {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $total     = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product) {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart) {
        // Manual ownership check
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated!');
    }

    public function remove(Cart $cart) {
        // Manual ownership check
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();
        return back()->with('success', 'Item removed from cart.');
    }
}