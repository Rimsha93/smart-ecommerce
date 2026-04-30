@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="text-center mb-5">
                <h2 class="section-title d-inline-block">Contact Support</h2>
                <p class="text-muted mt-2">Have a question or issue? We're here to help. Send us a message and we'll reply within 24 hours.</p>
            </div>
            <div class="card p-5" style="border-radius:20px">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-600">Subject *</label>
                        <input type="text" name="subject" class="form-control form-control-lg @error('subject') is-invalid @enderror"
                               value="{{ old('subject') }}" placeholder="What's your message about?" required>
                        @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-600">Message *</label>
                        <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                  rows="6" placeholder="Describe your issue or question in detail..." required>{{ old('message') }}</textarea>
                        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                        <i class="bi bi-send me-2"></i>Send Message
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <a href="{{ route('contact.messages') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-chat-dots me-1"></i>View My Messages & Replies
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection