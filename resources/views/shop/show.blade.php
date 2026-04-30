@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color:#e94560">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}" class="text-decoration-none" style="color:#e94560">Shop</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-md-5">
            <div class="card border-0" style="border-radius:20px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,.1)">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height:420px;object-fit:cover;width:100%">
                @else
                    <div style="height:420px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-box-seam" style="font-size:6rem;color:rgba(255,255,255,.2)"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-7">
            @if($product->category)
                <span class="badge px-3 py-2 mb-2" style="background:rgba(233,69,96,.1);color:#e94560;border-radius:50px">{{ $product->category->name }}</span>
            @endif
            <h1 class="mb-3" style="font-family:'Playfair Display',serif">{{ $product->name }}</h1>

            <div class="d-flex align-items-center gap-3 mb-3">
                <span class="display-6 fw-700" style="color:#e94560">${{ number_format($product->price, 2) }}</span>
                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} px-3 py-2" style="border-radius:50px">
                    {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of Stock' }}
                </span>
            </div>

            @if($product->description)
                <p class="text-muted lh-lg mb-4">{{ $product->description }}</p>
            @endif

            <hr>

            @auth
            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex gap-3 align-items-center">
                @csrf
                <div style="width:120px">
                    <label class="form-label small fw-600 mb-1">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-lg px-5"><i class="bi bi-cart-plus me-2"></i>Add to Cart</button>
                </div>
            </form>
            @else
                <div class="alert alert-danger"><i class="bi bi-x-circle me-2"></i>This product is out of stock.</div>
            @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5"><i class="bi bi-person me-2"></i>Login to Purchase</a>
            @endauth
        </div>
    </div>

    @if($related->count())
    <div class="mt-5 pt-3">
        <h3 class="section-title mb-4">Related Products</h3>
        <div class="row g-4">
            @foreach($related as $p)
            <div class="col-6 col-md-3">
                <div class="product-card card h-100">
                    <a href="{{ route('shop.show', $p->slug) }}">
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}">
                        @else
                            <div style="height:180px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-box-seam" style="font-size:3rem;color:rgba(255,255,255,.2)"></i>
                            </div>
                        @endif
                    </a>
                    <div class="card-body p-3">
                        <h6 class="fw-600 small"><a href="{{ route('shop.show', $p->slug) }}" class="text-decoration-none text-dark">{{ $p->name }}</a></h6>
                        <span class="fw-700" style="color:#e94560">${{ number_format($p->price, 2) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection