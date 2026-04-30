<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — SmartStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0f0f1a;
            --sidebar-width: 260px;
            --accent: #e94560;
            --accent-soft: rgba(233,69,96,0.12);
            --gold: #f0a500;
            --text-muted-custom: rgba(255,255,255,0.5);
        }
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #f0f2f8; margin: 0; }
        h1,h2,h3,h4,h5,h6 { font-family: 'DM Sans', sans-serif; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s;
        }
        .sidebar-brand {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #fff;
        }
        .sidebar-brand span { color: var(--accent); }
        .sidebar-nav { padding: 12px 0; }
        .nav-section-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--text-muted-custom);
            padding: 12px 20px 4px;
            font-weight: 600;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 10px 20px;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            position: relative;
        }
        .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.05); }
        .sidebar .nav-link.active {
            color: #fff;
            background: var(--accent-soft);
            border-left: 3px solid var(--accent);
        }
        .sidebar .nav-link i { font-size: 1rem; width: 20px; }

        /* Main content */
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar {
            background: #fff;
            padding: 12px 28px;
            border-bottom: 1px solid #e8eaf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .topbar-title { font-weight: 600; font-size: 1.1rem; color: #1a1a2e; }
        .content-area { padding: 28px; }

        /* Cards */
        .stat-card {
            border: none;
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }
        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-card .stat-value { font-size: 2rem; font-weight: 700; margin: 8px 0 2px; }
        .stat-card .stat-label { font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }

        .card { border: none; border-radius: 16px; box-shadow: 0 2px 16px rgba(0,0,0,0.06); }
        .card-header { background: #fff; border-bottom: 1px solid #f0f2f8; border-radius: 16px 16px 0 0 !important; padding: 16px 24px; font-weight: 600; }
        .table th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.06em; color: #6c757d; border-top: none; }
        .badge { font-weight: 600; padding: 6px 12px; border-radius: 50px; }
        .btn-primary { background: var(--accent); border-color: var(--accent); }
        .btn-primary:hover { background: #c73652; border-color: #c73652; }
        .form-control:focus, .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(233,69,96,0.15); }

        @media(max-width:992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-bag-heart-fill me-2" style="color:var(--accent)"></i>Smart<span>Store</span>
        <div style="font-size:0.7rem;color:rgba(255,255,255,0.4);font-family:'DM Sans',sans-serif;font-weight:400;margin-top:2px">Admin Dashboard</div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section-label">Catalog</div>
        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>

        <div class="nav-section-label">Commerce</div>
        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Orders
        </a>
        <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Customers
        </a>

        <div class="nav-section-label">Support</div>
        <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i> Messages
            @php $openCount = \App\Models\Contact::where('status','open')->count(); @endphp
            @if($openCount) <span class="badge ms-auto" style="background:var(--accent);">{{ $openCount }}</span> @endif
        </a>

        <div class="nav-section-label mt-3">Account</div>
        <a href="{{ route('home') }}" class="nav-link">
            <i class="bi bi-shop"></i> View Store
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link border-0 w-100 text-start" style="background:none;cursor:pointer;color:rgba(255,100,100,0.8)">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('open')" style="border:1px solid #e0e0e0">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small me-2">{{ auth()->user()->name }}</span>
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                 style="width:36px;height:36px;background:var(--accent);font-size:0.85rem">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
        </div>
    </div>

    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="border-radius:12px">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0" role="alert" style="border-radius:12px">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>