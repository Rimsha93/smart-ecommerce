<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller {
    public function index() {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request) {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone'            => 'required|string',
        ]);

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id'          => auth()->id(),
            'total_amount'     => $total,
            'status'           => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone'            => $request->phone,
            'notes'            => $request->notes,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }
}