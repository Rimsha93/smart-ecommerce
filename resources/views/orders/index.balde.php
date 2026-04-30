@extends('layouts.app')
@section('title', 'My Orders')
@section('content')
<div class="container py-5">
    <h2 class="section-title mb-4">My Orders</h2>
    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-bag-x" style="font-size:4rem;color:#ddd"></i>
            <h5 class="text-muted mt-3">No orders yet</h5>
            <a href="{{ route('shop') }}" class="btn btn-primary mt-2">Start Shopping</a>
        </div>
    @else
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>{{ $order->items()->count() }} items</td>
                        <td class="fw-700" style="color:#e94560">${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="badge badge-status-{{ $order->status }} px-3 py-2" style="border-radius:50px;text-transform:capitalize">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td><a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View Details</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $orders->links() }}</div>
    @endif
</div>
@endsection