@extends('layouts.admin')
@section('title', 'Orders')
@section('page-title', 'Order Management')

@section('content')
<div class="card">
    <div class="card-body">
        <table id="ordersTable" class="table table-hover align-middle w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
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
    $('#ordersTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin.orders.index") }}',
        columns: [
            { data: 'DT_RowIndex',      name: 'DT_RowIndex',  orderable: false, searchable: false, width:'40px' },
            { data: 'customer',         name: 'users.name',   orderable: false },
            { data: 'items_count',      name: 'items_count',  orderable: false, searchable: false },
            { data: 'total_formatted',  name: 'total_amount' },
            { data: 'status_badge',     name: 'status' },
            { data: 'date',             name: 'created_at' },
            { data: 'actions',          name: 'actions',      orderable: false, searchable: false },
        ],
        order: [[5, 'desc']],
        pageLength: 10,
        language: {
            processing: '<div class="spinner-border text-danger" role="status"></div>',
            emptyTable: 'No orders found.',
        },
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
    });
});
</script>
@endpush