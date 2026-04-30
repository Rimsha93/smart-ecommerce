@extends('layouts.app')
@section('title', 'Home')
@section('content')

<!-- Hero Slider -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);height:520px;display:flex;align-items:center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <span class="badge mb-3 px-3 py-2" style="background:rgba(233,69,96,0.2);color:#e94560;font-size:.8rem;border-radius:50px">🔥 New Collection</span>
                            <h1 class="display-4 fw-bold text-white mb-3" style="font-family:'Playfair Display',serif;line-height:1.2">Discover Premium <span style="color:#e94560">Electronics</span></h1>
                            <p class="text-white-50 mb-4 fs-5">Shop the latest gadgets and tech accessories at unbeatable prices.</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-5 me-2">Shop Now <i class="bi bi-arrow-right ms-1"></i></a>
                            <a href="#featured" class="btn btn-outline-light btn-lg px-4">Explore</a>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                            <div style="width:280px;height:280px;background:rgba(233,69,96,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-headphones" style="font-size:8rem;color:#e94560;opacity:.8"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div style="background:linear-gradient(135deg,#0d1b2a 0%,#1b2838 50%,#2d6a4f 100%);height:520px;display:flex;align-items:center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <span class="badge mb-3 px-3 py-2" style="background:rgba(52,211,153,0.2);color:#34d399;font-size:.8rem;border-radius:50px">🌿 Lifestyle</span>
                            <h1 class="display-4 fw-bold text-white mb-3" style="font-family:'Playfair Display',serif;line-height:1.2">Style That <span style="color:#34d399">Speaks</span> Volumes</h1>
                            <p class="text-white-50 mb-4 fs-5">Fashion forward clothing for every occasion and lifestyle.</p>
                            <a href="{{ route('shop') }}" class="btn btn-lg px-5" style="background:#34d399;color:#0d1b2a;font-weight:700">Shop Fashion <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                            <div style="width:280px;height:280px;background:rgba(52,211,153,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-bag-heart" style="font-size:8rem;color:#34d399;opacity:.8"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div style="background:linear-gradient(135deg,#1a0a00 0%,#3d1c02 50%,#7c3a00 100%);height:520px;display:flex;align-items:center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <span class="badge mb-3 px-3 py-2" style="background:rgba(240,165,0,0.2);color:#f0a500;font-size:.8rem;border-radius:50px">⚡ Flash Sale</span>
                            <h1 class="display-4 fw-bold text-white mb-3" style="font-family:'Playfair Display',serif;line-height:1.2">Up to <span style="color:#f0a500">50% Off</span> Everything</h1>
                            <p class="text-white-50 mb-4 fs-5">Limited time offers on thousands of products. Don't miss out!</p>
                            <a href="{{ route('shop') }}" class="btn btn-lg px-5" style="background:#f0a500;color:#1a0a00;font-weight:700">Grab Deals <i class="bi bi-lightning-fill ms-1"></i></a>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                            <div style="width:280px;height:280px;background:rgba(240,165,0,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-tags" style="font-size:8rem;color:#f0a500;opacity:.8"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Stats Bar -->
<div style="background:#fff;border-bottom:1px solid #f0f2f8">
    <div class="container py-3">
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-truck fs-4" style="color:#e94560"></i>
                    <div class="text-start">
                        <div class="fw-700 small">Free Shipping</div>
                        <div class="text-muted" style="font-size:.7rem">Orders over $50</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-shield-check fs-4" style="color:#e94560"></i>
                    <div class="text-start">
                        <div class="fw-700 small">Secure Payment</div>
                        <div class="text-muted" style="font-size:.7rem">100% Protected</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-arrow-counterclockwise fs-4" style="color:#e94560"></i>
                    <div class="text-start">
                        <div class="fw-700 small">Easy Returns</div>
                        <div class="text-muted" style="font-size:.7rem">30 day policy</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-headset fs-4" style="color:#e94560"></i>
                    <div class="text-start">
                        <div class="fw-700 small">24/7 Support</div>
                        <div class="text-muted" style="font-size:.7rem">Always here</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories -->
@if($categories->count())
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="section-title mb-0">Shop by Category</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary btn-sm">View All <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-3">
        @foreach($categories as $cat)
        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ route('shop', ['category' => $cat->id]) }}" class="text-decoration-none">
                <div class="card text-center p-3 h-100" style="border-radius:16px;transition:all .25s;border:2px solid transparent" onmouseover="this.style.borderColor='#e94560'" onmouseout="this.style.borderColor='transparent'">
                    <div style="width:52px;height:52px;background:rgba(233,69,96,.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px">
                        <i class="bi bi-grid-3x3-gap fs-4" style="color:#e94560"></i>
                    </div>
                    <div class="fw-600 small text-dark">{{ $cat->name }}</div>
                    <div class="text-muted" style="font-size:.7rem">{{ $cat->products_count }} items</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Featured Products -->
<div class="container pb-5" id="featured">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="section-title mb-0">Featured Products</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary btn-sm">View All <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-4">
        @forelse($featuredProducts as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card card h-100">
                <a href="{{ route('shop.show', $product->slug) }}">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div style="height:220px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
                            <i class="bi bi-box-seam" style="font-size:4rem;color:rgba(255,255,255,.2)"></i>
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
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>
                    @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
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
                <i class="bi bi-inbox" style="font-size:3rem;color:#ccc"></i>
                <p class="text-muted mt-2">No products yet.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection