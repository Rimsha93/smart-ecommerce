@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Support Messages')

@section('content')
<div class="card">
    <div class="card-body">
        <table id="contactsTable" class="table table-hover align-middle w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#contactsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin.contacts.index") }}',
        columns: [
            { data: 'DT_RowIndex',  name: 'DT_RowIndex', orderable: false, searchable: false, width:'40px' },
            { data: 'customer',     name: 'users.name',  orderable: false },
            { data: 'subject',      name: 'subject' },
            { data: 'status_badge', name: 'status' },
            { data: 'date',         name: 'created_at' },
            { data: 'actions',      name: 'actions',     orderable: false, searchable: false },
        ],
        order: [[4, 'desc']],
        pageLength: 10,
        language: {
            processing: '<div class="spinner-border text-danger" role="status"></div>',
            emptyTable: 'No messages found.',
        },
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
    });
});
</script>
@endpush