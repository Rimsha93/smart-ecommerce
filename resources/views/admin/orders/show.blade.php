@extends('layouts.admin')
@section('title', 'Order #' . $order->id)
@section('page-title', 'Order #' . $order->id . ' Details')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <!-- Order Items -->
        <div class="card mb-4">
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
                                        <img src="{{ asset('storage/'.$item->product->image) }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px">
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
                        <tr><td colspan="3" class="text-end fw-700">Total</td><td class="fw-700 fs-5" style="color:#e94560">${{ number_format($order->total_amount, 2) }}</td></tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Update Status -->
        <div class="card p-4">
            <h6 class="fw-700 mb-3"><i class="bi bi-arrow-repeat me-2" style="color:#e94560"></i>Update Order Status</h6>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-flex gap-3 align-items-end">
                @csrf @method('PATCH')
                <div class="flex-grow-1">
                    <select name="status" class="form-select">
                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary px-4">Update Status</button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-4 mb-4">
            <h6 class="fw-700 mb-3"><i class="bi bi-person me-2" style="color:#e94560"></i>Customer</h6>
            <p class="mb-1 fw-600">{{ $order->user->name }}</p>
            <p class="mb-1 text-muted small">{{ $order->user->email }}</p>
            <a href="{{ route('admin.customers.show', $order->user) }}" class="btn btn-sm btn-outline-primary mt-2">View Profile</a>
        </div>
        <div class="card p-4 mb-4">
            <h6 class="fw-700 mb-3"><i class="bi bi-geo-alt me-2" style="color:#e94560"></i>Shipping Info</h6>
            <p class="mb-1 small"><strong>Address:</strong><br>{{ $order->shipping_address }}</p>
            <p class="mb-1 small"><strong>Phone:</strong> {{ $order->phone }}</p>
            @if($order->notes) <p class="mb-0 small"><strong>Notes:</strong> {{ $order->notes }}</p> @endif
        </div>
        <div class="card p-4">
            <h6 class="fw-700 mb-2">Status</h6>
            <span class="badge badge-status-{{ $order->status }} px-3 py-2" style="border-radius:50px;text-transform:capitalize;font-size:.85rem">{{ $order->status }}</span>
            <div class="mt-3 text-muted small">Ordered: {{ $order->created_at->format('M d, Y h:i A') }}</div>
        </div>
    </div>
</div>
@endsection