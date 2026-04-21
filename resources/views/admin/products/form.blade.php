@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('content')
    <div style="max-width:680px;">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <form method="POST"
                action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Nama Produk *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}"
                            required style="border-radius:10px;border:2px solid #eef2f2;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori *</label>
                        <select name="category_id" class="form-select" required
                            style="border-radius:10px;border:2px solid #eef2f2;">
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Satuan *</label>
                        <input type="text" name="unit" class="form-control"
                            value="{{ old('unit', $product->unit ?? 'Botol') }}" required
                            style="border-radius:10px;border:2px solid #eef2f2;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Harga (Rp) *</label>
                        <input type="number" name="price" class="form-control"
                            value="{{ old('price', $product->price ?? '') }}" required
                            style="border-radius:10px;border:2px solid #eef2f2;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Stok *</label>
                        <input type="number" name="stock" class="form-control"
                            value="{{ old('stock', $product->stock ?? 0) }}" required
                            style="border-radius:10px;border:2px solid #eef2f2;">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4"
                            style="border-radius:10px;border:2px solid #eef2f2;">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Gambar Produk</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            style="border-radius:10px;border:2px solid #eef2f2;">
                        @if(isset($product) && $product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" height="60" class="mt-2 rounded">
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="isActive">Produk Aktif</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn-sm-teal"
                            style="padding:0.7rem 2rem;border-radius:10px;font-size:0.95rem;">
                            <i class="bi bi-check-circle me-1"></i>{{ isset($product) ? 'Update Produk' : 'Simpan Produk' }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light"
                            style="border-radius:10px;padding:0.7rem 1.5rem;">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection