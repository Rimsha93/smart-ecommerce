@extends('layouts.admin')
@section('title', 'Message Detail')
@section('page-title', 'Support Message')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- User Message -->
        <div class="card p-5 mb-4">
            <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-700"
                     style="width:48px;height:48px;background:#e94560;font-size:1.1rem;flex-shrink:0">
                    {{ strtoupper(substr($contact->user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="fw-700">{{ $contact->user->name }}</div>
                    <div class="text-muted small">{{ $contact->user->email }} · {{ $contact->created_at->format('M d, Y h:i A') }}</div>
                </div>
                <div class="ms-auto">
                    <span class="badge {{ $contact->status == 'replied' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2" style="border-radius:50px">
                        {{ $contact->status == 'replied' ? '✓ Replied' : '⏳ Awaiting Reply' }}
                    </span>
                </div>
            </div>
            <h4 class="fw-700 mb-3">{{ $contact->subject }}</h4>
            <p class="text-muted lh-lg">{{ $contact->message }}</p>
        </div>

        <!-- Existing Reply -->
        @if($contact->admin_reply)
        <div class="card p-4 mb-4" style="background:linear-gradient(135deg,rgba(25,135,84,.04),rgba(25,135,84,.08));border:1px solid rgba(25,135,84,.2)">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-700"
                     style="width:36px;height:36px;background:#198754;font-size:.85rem">A</div>
                <div>
                    <div class="fw-600 text-success">Admin Reply</div>
                    <div class="text-muted small">{{ $contact->replied_at?->format('M d, Y h:i A') }}</div>
                </div>
            </div>
            <p class="mb-0 lh-lg">{{ $contact->admin_reply }}</p>
        </div>
        @endif

        <!-- Reply Form -->
        <div class="card p-5">
            <h6 class="fw-700 mb-4"><i class="bi bi-reply me-2" style="color:#e94560"></i>{{ $contact->admin_reply ? 'Update Reply' : 'Send Reply' }}</h6>
            <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <textarea name="reply" class="form-control @error('reply') is-invalid @enderror"
                              rows="5" placeholder="Type your reply here...">{{ old('reply', $contact->admin_reply) }}</textarea>
                    @error('reply') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-send me-2"></i>{{ $contact->admin_reply ? 'Update Reply' : 'Send Reply' }}
                    </button>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">Back to Messages</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection