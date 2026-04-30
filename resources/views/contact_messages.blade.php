@extends('layouts.app')
@section('title', 'My Messages')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">My Messages</h2>
        <a href="{{ route('contact.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus me-1"></i>New Message</a>
    </div>

    @if($messages->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-chat-square-dots" style="font-size:4rem;color:#ddd"></i>
            <h5 class="text-muted mt-3">No messages yet</h5>
            <a href="{{ route('contact.index') }}" class="btn btn-primary mt-2">Send a Message</a>
        </div>
    @else
    <div class="row g-3">
        @foreach($messages as $msg)
        <div class="col-12">
            <div class="card p-4" style="border-left:4px solid {{ $msg->status == 'replied' ? '#198754' : '#e94560' }};border-radius:12px">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="fw-700 mb-0">{{ $msg->subject }}</h6>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge {{ $msg->status == 'replied' ? 'bg-success' : 'bg-warning text-dark' }} px-3" style="border-radius:50px">
                            {{ $msg->status == 'replied' ? '✓ Replied' : '⏳ Pending' }}
                        </span>
                        <span class="text-muted small">{{ $msg->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                <p class="text-muted mb-0 small">{{ $msg->message }}</p>

                @if($msg->admin_reply)
                <div class="mt-3 p-3 rounded-3" style="background:linear-gradient(135deg,rgba(25,135,84,.05),rgba(25,135,84,.1));border:1px solid rgba(25,135,84,.2)">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-700"
                             style="width:28px;height:28px;background:#198754;font-size:.7rem">A</div>
                        <strong class="small text-success">Admin Reply</strong>
                        <span class="text-muted" style="font-size:.7rem">{{ $msg->replied_at?->format('M d, Y') }}</span>
                    </div>
                    <p class="mb-0 small">{{ $msg->admin_reply }}</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection