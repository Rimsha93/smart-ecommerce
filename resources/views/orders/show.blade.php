@extends('layouts.app')
@section('title', 'Order #' . $order->id)
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">Order #{{ $order->id }}</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Orders</a>
    </div>

    <!-- Status Timeline -->
    <div class="card mb-4 p-4">
        <h6 class="fw-700 mb-3">Order Status</h6>
        <div class="d-flex justify-content-between align-items-center position-relative" style="padding:0 20px">
            <div style="position:absolute;top:20px;left:40px;right:40px;height:3px;background:#e9ecef;z-index:0"></div>
            @foreach(['pending','processing','shipped','delivered'] as $step)
            @php
                $steps = ['pending'=>0,'processing'=>1,'shipped'=>2,'delivered'=>3];
                $currentStep = $steps[$order->status] ?? 0;
                $thisStep = $steps[$step];
                $isDone = $thisStep <= $currentStep && $order->status != 'cancelled';
                $isCancelled = $order->status == 'cancelled';
            @endphp
            <div class="text-center position-relative" style="z-index:1;flex:1">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center fw-700"
                     style="width:40px;height:40px;background:{{ $isCancelled ? '#dc3545' : ($isDone ? '#e94560' : '#dee2e6') }};color:{{ ($isDone || $isCancelled) ? '#fff' : '#6c757d' }};font-size:.8rem">
                    @if($isCancelled && $step == 'pending') <i class="bi bi-x"></i>
                    @elseif($isDone) <i class="bi bi-check"></i>
                    @else {{ $thisStep + 1 }} @endif
                </div>
                <div class="mt-2 small fw-600 text-capitalize" style="color:{{ $isDone ? '#e94560' : '#6c757d' }}">{{ $step }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="bi bi-box-seam me-2"></i>Order Items</div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light"><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" style="width:45px;height:45px;object-fit:cover;border-radius:8px">
                                        @endif
                                        <span class="fw-600">{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-700">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr><td colspan="3" class="fw-700 text-end">Total</td><td class="fw-700 fs-5" style="color:#e94560">${{ number_format($order->total_amount, 2) }}</td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 mb-3">
                <h6 class="fw-700 mb-3"><i class="bi bi-geo-alt me-2" style="color:#e94560"></i>Shipping Info</h6>
                <p class="mb-1 small"><strong>Address:</strong><br>{{ $order->shipping_address }}</p>
                <p class="mb-1 small"><strong>Phone:</strong> {{ $order->phone }}</p>
                @if($order->notes)
                    <p class="mb-0 small"><strong>Notes:</strong> {{ $order->notes }}</p>
                @endif
            </div>
            <div class="card p-4">
                <h6 class="fw-700 mb-2">Order Date</h6>
                <p class="mb-0 text-muted small">{{ $order->created_at->format('F d, Y — h:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection