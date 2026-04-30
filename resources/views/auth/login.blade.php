@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0" style="border-radius:20px;overflow:hidden">
                <div style="background:linear-gradient(135deg,#1a1a2e,#16213e);padding:32px;text-align:center">
                    <i class="bi bi-bag-heart-fill" style="font-size:2.5rem;color:#e94560"></i>
                    <h3 class="text-white mt-2 mb-0" style="font-family:'Playfair Display',serif">Welcome Back</h3>
                    <p style="color:rgba(255,255,255,0.5);font-size:.85rem;margin-top:4px">Sign in to your account</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-600 small">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="you@example.com" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-600 small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label small" for="remember">Remember me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-600">Sign In <i class="bi bi-arrow-right ms-1"></i></button>
                    </form>
                    <hr>
                    <p class="text-center small mb-0">Don't have an account? <a href="{{ route('register') }}" style="color:#e94560;font-weight:600">Register now</a></p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection