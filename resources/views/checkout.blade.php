@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="container py-5">
    <h2 class="section-title mb-4">Checkout</h2>
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card p-4">
                <h5 class="fw-700 mb-4"><i class="bi bi-geo-alt me-2" style="color:#e94560"></i>Shipping Information</h5>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-600 small">Full Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600 small">Phone Number *</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', auth()->user()->phone) }}" placeholder="+1 (555) 000-0000" required>
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600 small">Shipping Address *</label>
                        <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"
                                  rows="3" placeholder="Street address, city, state, zip code" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                        @error('shipping_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-600 small">Order Notes (Optional)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions?"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                        <i class="bi bi-bag-check me-2"></i>Place Order — ${{ number_format($total + ($total >= 50 ? 0 : 5), 2) }}
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card p-4">
                <h5 class="fw-700 mb-3">Order Items</h5>
                @foreach($cartItems as $item)
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill" style="background:#e94560">{{ $item->quantity }}</span>
                        <span class="small fw-600">{{ $item->product->name }}</span>
                    </div>
                    <span class="small fw-700">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between fw-700 fs-5">
                    <span>Total</span>
                    <span style="color:#e94560">${{ number_format($total + ($total >= 50 ? 0 : 5), 2) }}</span>
                </div>
                <div class="mt-3 p-3 rounded-3" style="background:#f8f9fc">
                    <div class="d-flex gap-2 text-muted small"><i class="bi bi-shield-check text-success mt-1"></i><span>Your order is protected by our secure payment system.</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection