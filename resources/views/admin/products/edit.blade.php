@extends('layouts.admin')
@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-5">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-600">Product Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">No Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600">Price ($) *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600">Stock Quantity *</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600">Product Image</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$product->image) }}" style="max-height:120px;border-radius:10px">
                                <small class="text-muted d-block mt-1">Current image — upload new to replace</small>
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="isActive">Active (visible in shop)</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-3 pt-2">
                        <button type="submit" class="btn btn-primary px-5"><i class="bi bi-check-lg me-2"></i>Update Product</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection