@extends('layouts.admin')
@section('title', 'Add Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-5">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-600">Product Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="e.g. Wireless Headphones" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">No Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600">Price ($) *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price') }}" step="0.01" min="0" placeholder="0.00" required>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600">Stock Quantity *</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                               value="{{ old('stock', 0) }}" min="0" required>
                        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Product description...">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600">Product Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*"
                               onchange="document.getElementById('preview').src=URL.createObjectURL(this.files[0]);document.getElementById('preview').style.display='block'">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <img id="preview" src="" style="display:none;max-height:150px;margin-top:10px;border-radius:10px">
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="isActive">Active (visible in shop)</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-3 pt-2">
                        <button type="submit" class="btn btn-primary px-5"><i class="bi bi-check-lg me-2"></i>Create Product</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection