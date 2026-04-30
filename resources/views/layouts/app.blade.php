<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Store') — Smart Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
            --accent-light: #ff6b6b;
            --gold: #f0a500;
            --surface: #f8f9fc;
            --card-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: #1a1a2e; }
        h1,h2,h3,h4,h5 { font-family: 'Playfair Display', serif; }
        .navbar { background: var(--primary) !important; box-shadow: 0 2px 20px rgba(0,0,0,0.3); }
        .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #fff !important; }
        .navbar-brand span { color: var(--accent); }
        .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; transition: color 0.2s; }
        .nav-link:hover { color: var(--accent) !important; }
        .btn-primary { background: var(--accent); border-color: var(--accent); font-weight: 600; }
        .btn-primary:hover { background: #c73652; border-color: #c73652; }
        .btn-outline-primary { border-color: var(--accent); color: var(--accent); }
        .btn-outline-primary:hover { background: var(--accent); border-color: var(--accent); }
        .cart-badge { background: var(--accent); }
        .product-card { border: none; border-radius: 16px; box-shadow: var(--card-shadow); transition: transform 0.25s, box-shadow 0.25s; overflow: hidden; }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 12px 40px rgba(0,0,0,0.15); }
        .product-card img { height: 220px; object-fit: cover; width: 100%; }
        .badge-status-pending    { background: #fff3cd; color: #856404; }
        .badge-status-processing { background: #cff4fc; color: #055160; }
        .badge-status-shipped    { background: #cfe2ff; color: #084298; }
        .badge-status-delivered  { background: #d1e7dd; color: #0a3622; }
        .badge-status-cancelled  { background: #f8d7da; color: #842029; }
        footer { background: var(--primary); color: rgba(255,255,255,0.7); padding: 40px 0 20px; }
        .section-title { font-size: 2.2rem; color: var(--primary); position: relative; display: inline-block; }
        .section-title::after { content:''; display:block; width:60px; height:4px; background:var(--accent); border-radius:2px; margin-top:8px; }
        .alert { border-radius: 12px; border: none; }
        @media(max-width:768px) { .product-card img { height: 180px; } }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-bag-heart-fill me-1"></i>Smart<span>Store</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">My Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact.messages') }}">My Messages</a></li>
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item me-2">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3 fs-5"></i>
                            @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity'); @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Admin Panel</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-primary btn-sm px-3" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container py-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
    @yield('content')
</main>

<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="text-white mb-2" style="font-family:'Playfair Display',serif;">Smart<span style="color:#e94560;">Store</span></h5>
                <p class="small">Your one-stop shop for quality products at great prices.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="text-white">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('home') }}" class="text-decoration-none" style="color:rgba(255,255,255,0.6)">Home</a></li>
                    <li><a href="{{ route('shop') }}" class="text-decoration-none" style="color:rgba(255,255,255,0.6)">Shop</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-decoration-none" style="color:rgba(255,255,255,0.6)">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="text-white">Contact</h6>
                <p class="small"><i class="bi bi-envelope me-1"></i>support@smartstore.com</p>
                <p class="small"><i class="bi bi-telephone me-1"></i>+1 (555) 000-0000</p>
            </div>
        </div>
        <hr style="border-color:rgba(255,255,255,0.1)">
        <p class="text-center small mb-0">&copy; {{ date('Y') }} SmartStore. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>