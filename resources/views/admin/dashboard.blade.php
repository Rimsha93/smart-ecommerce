@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat-card" style="background:linear-gradient(135deg,#1a1a2e,#16213e)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label text-white-50">Total Revenue</div>
                    <div class="stat-value text-white">${{ number_format($totalRevenue, 0) }}</div>
                    <div class="small text-white-50">From delivered orders</div>
                </div>
                <div class="stat-icon" style="background:rgba(240,165,0,.2)"><i class="bi bi-currency-dollar" style="color:#f0a500"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card" style="background:linear-gradient(135deg,#e94560,#c73652)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label text-white-50">Total Orders</div>
                    <div class="stat-value text-white">{{ $totalOrders }}</div>
                    <div class="small text-white-50">{{ $pendingOrders }} pending</div>
                </div>
                <div class="stat-icon" style="background:rgba(255,255,255,.2)"><i class="bi bi-bag-check text-white"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card" style="background:linear-gradient(135deg,#0f3460,#084298)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label text-white-50">Customers</div>
                    <div class="stat-value text-white">{{ $totalUsers }}</div>
                    <div class="small text-white-50">Registered users</div>
                </div>
                <div class="stat-icon" style="background:rgba(255,255,255,.15)"><i class="bi bi-people text-white"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card" style="background:linear-gradient(135deg,#198754,#0a3622)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label text-white-50">Products</div>
                    <div class="stat-value text-white">{{ $totalProducts }}</div>
                    <div class="small text-white-50">{{ $openMessages }} open messages</div>
                </div>
                <div class="stat-icon" style="background:rgba(255,255,255,.15)"><i class="bi bi-box-seam text-white"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2" style="color:#e94560"></i>Recent Orders</span>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead><tr><th>Order</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="fw-600 text-decoration-none" style="color:#e94560">#{{ $order->id }}</a></td>
                            <td>{{ $order->user->name }}</td>
                            <td class="fw-600">${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge badge-status-{{ $order->status }} px-3 py-2" style="border-radius:50px;text-transform:capitalize">{{ $order->status }}</span>
                            </td>
                            <td class="text-muted small">{{ $order->created_at->format('M d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card p-4">
            <h6 class="fw-700 mb-3"><i class="bi bi-lightning me-2" style="color:#e94560"></i>Quick Actions</h6>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add New Product</a>
                <a href="{{ route('admin.orders.index', ['status'=>'pending']) }}" class="btn btn-warning"><i class="bi bi-hourglass me-2"></i>Pending Orders ({{ $pendingOrders }})</a>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-info text-white"><i class="bi bi-chat-dots me-2"></i>Open Messages ({{ $openMessages }})</a>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary"><i class="bi bi-people me-2"></i>View Customers</a>
            </div>
        </div>
    </div>
</div>
@endsection