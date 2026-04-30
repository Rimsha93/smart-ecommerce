@extends('layouts.admin')
@section('title', $user->name)
@section('page-title', $user->name . '\'s Profile')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card p-4 text-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-3"
                 style="width:80px;height:80px;background:#e94560;font-size:2rem">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h5 class="fw-700 mb-1">{{ $user->name }}</h5>
            <p class="text-muted small mb-0">{{ $user->email }}</p>
            @if($user->phone) <p class="text-muted small">{{ $user->phone }}</p> @endif
            <hr>
            <div class="row text-center">
                <div class="col-6">
                    <div class="fw-700 fs-4" style="color:#e94560">{{ $user->orders->count() }}</div>
                    <div class="text-muted small">Orders</div>
                </div>
                <div class="col-6">
                    <div class="fw-700 fs-4" style="color:#e94560">${{ number_format($user->orders->sum('total_amount'), 0) }}</div>
                    <div class="text-muted small">Spent</div>
                </div>
            </div>
            <hr>
            <p class="text-muted small mb-0">Member since {{ $user->created_at->format('M Y') }}</p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Order History</div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light"><tr><th>Order #</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                        @forelse($user->orders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="fw-600 text-decoration-none" style="color:#e94560">#{{ $order->id }}</a></td>
                            <td>{{ $order->items->count() }}</td>
                            <td class="fw-700">${{ number_format($order->total_amount, 2) }}</td>
                            <td><span class="badge badge-status-{{ $order->status }} px-3 py-2" style="border-radius:50px;text-transform:capitalize">{{ $order->status }}</span></td>
                            <td class="text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection