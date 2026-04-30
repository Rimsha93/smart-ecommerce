@extends('layouts.admin')
@section('title', 'Products')
@section('page-title', 'Product Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage your product catalog</p>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Add Product
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="productsTable" class="table table-hover align-middle w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin.products.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '40px' },
            { data: 'image',          name: 'image',       orderable: false, searchable: false, width: '60px' },
            { data: 'name',           name: 'name' },
            { data: 'category_name',  name: 'category.name', orderable: false },
            { data: 'price_formatted',name: 'price',       orderable: true  },
            { data: 'stock_badge',    name: 'stock',       orderable: true  },
            { data: 'status_badge',   name: 'is_active',   orderable: false },
            { data: 'actions',        name: 'actions',     orderable: false, searchable: false },
        ],
        pageLength: 10,
        language: {
            processing: '<div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div>',
            search: '<i class="bi bi-search me-1"></i> Search:',
            lengthMenu: 'Show _MENU_ entries',
            emptyTable: 'No products found.',
        },
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
    });
});
</script>
@endpush