@extends('layouts.app')
@section('title', 'Shop')
@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 mb-4">
            <div class="card p-4" style="border-radius:16px;position:sticky;top:80px">
                <h6 class="fw-700 mb-3"><i class="bi bi-funnel me-2" style="color:#e94560"></i>Filter Products</h6>
                <form method="GET" action="{{ route('shop') }}">
                    <div class="mb-3">
                        <label class="form-label small fw-600">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search products..." value="{{ request('search') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-600">Category</label>
                        <select name="category" class="form-select form-select-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-600">Sort By</label>
                        <select name="sort" class="form-select form-select-sm">
                            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
                    @if(request()->hasAny(['search','category','sort']))
                        <a href="{{ route('shop') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Clear Filters</a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0" style="font-family:'Playfair Display',serif">
                    @if(request('search')) Results for "<strong>{{ request('search') }}</strong>"
                    @else All Products
                    @endif
                </h4>
                <span class="text-muted small">{{ $products->total() }} products found</span>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-6 col-md-4">
                    <div class="product-card card h-100">
                        <a href="{{ route('shop.show', $product->slug) }}">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div style="height:220px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-box-seam" style="font-size:3.5rem;color:rgba(255,255,255,.2)"></i>
                                </div>
                            @endif
                        </a>
                        <div class="card-body d-flex flex-column p-3">
                            @if($product->category)
                                <span class="badge mb-1 px-2 py-1" style="background:rgba(233,69,96,.1);color:#e94560;font-size:.65rem;width:fit-content;border-radius:50px">{{ $product->category->name }}</span>
                            @endif
                            <h6 class="fw-600 mb-1 flex-grow-1">
                                <a href="{{ route('shop.show', $product->slug) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
                            </h6>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="fw-700 fs-5" style="color:#e94560">${{ number_format($product->price, 2) }}</span>
                                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}" style="font-size:.65rem">
                                    {{ $product->stock > 0 ? 'In Stock' : 'Out' }}
                                </span>
                            </div>
                            @auth
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                                @csrf <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm w-100" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100 mt-2">Login to Buy</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search" style="font-size:3rem;color:#ccc"></i>
                    <h5 class="text-muted mt-3">No products found</h5>
                    <a href="{{ route('shop') }}" class="btn btn-primary mt-2">Clear Filters</a>
                </div>
                @endforelse
            </div>

            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection