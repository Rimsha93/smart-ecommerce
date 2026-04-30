@extends('layouts.admin')
@section('title', 'Customers')
@section('page-title', 'Customer Management')

@section('content')
<div class="card">
    <div class="card-body">
        <table id="customersTable" class="table table-hover align-middle w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Orders</th>
                    <th>Joined</th>
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
    $('#customersTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin.customers.index") }}',
        columns: [
            { data: 'DT_RowIndex',  name: 'DT_RowIndex', orderable: false, searchable: false, width:'40px' },
            { data: 'avatar',       name: 'avatar',      orderable: false, searchable: false, width:'50px' },
            { data: 'name',         name: 'name' },
            { data: 'email',        name: 'email' },
            { data: 'orders_badge', name: 'orders_count', orderable: true, searchable: false },
            { data: 'joined',       name: 'created_at' },
            { data: 'actions',      name: 'actions',     orderable: false, searchable: false },
        ],
        pageLength: 10,
        language: {
            processing: '<div class="spinner-border text-danger" role="status"></div>',
            emptyTable: 'No customers found.',
        },
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
    });
});
</script>
@endpush