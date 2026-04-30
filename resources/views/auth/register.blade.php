@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0" style="border-radius:20px;overflow:hidden">
                <div style="background:linear-gradient(135deg,#1a1a2e,#16213e);padding:32px;text-align:center">
                    <i class="bi bi-person-plus-fill" style="font-size:2.5rem;color:#e94560"></i>
                    <h3 class="text-white mt-2 mb-0" style="font-family:'Playfair Display',serif">Create Account</h3>
                    <p style="color:rgba(255,255,255,0.5);font-size:.85rem;margin-top:4px">Join thousands of happy customers</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-600">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="John Doe" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-600">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="you@example.com" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-600">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-600">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-600">Create Account <i class="bi bi-arrow-right ms-1"></i></button>
                    </form>
                    <hr>
                    <p class="text-center small mb-0">Already have an account? <a href="{{ route('login') }}" style="color:#e94560;font-weight:600">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection