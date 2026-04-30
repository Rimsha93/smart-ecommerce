@extends('layouts.app')
@section('title', 'My Cart')
@section('content')
<div class="container py-5">
    <h2 class="section-title mb-4">Shopping Cart</h2>

    @if($cartItems->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size:5rem;color:#ddd"></i>
            <h4 class="text-muted mt-3">Your cart is empty</h4>
            <a href="{{ route('shop') }}" class="btn btn-primary mt-3 px-5">Continue Shopping</a>
        </div>
    @else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-0">
                    @foreach($cartItems as $item)
                    <div class="d-flex align-items-center gap-3 p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div style="width:80px;height:80px;border-radius:12px;overflow:hidden;flex-shrink:0">
                            @if($item->product->image)
                                <img src="{{ asset('storage/'.$item->product->image) }}" class="w-100 h-100" style="object-fit:cover">
                            @else
                                <div style="width:100%;height:100%;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-box-seam text-white-50"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-600 mb-1">{{ $item->product->name }}</h6>
                            <span class="fw-700" style="color:#e94560">${{ number_format($item->product->price, 2) }}</span>
                        </div>
                        <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width:70px">
                            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-repeat"></i></button>
                        </form>
                        <div class="text-end ms-2">
                            <div class="fw-700">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger p-0 border-0"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4" style="border-radius:16px;position:sticky;top:90px">
                <h5 class="fw-700 mb-3">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2 text-muted small">
                    <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2 text-muted small">
                    <span>Shipping</span>
                    <span class="text-success">{{ $total >= 50 ? 'Free' : '$5.00' }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-700 fs-5 mb-4">
                    <span>Total</span>
                    <span style="color:#e94560">${{ number_format($total + ($total >= 50 ? 0 : 5), 2) }}</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 py-2">
                    Proceed to Checkout <i class="bi bi-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection