@extends('layouts.shop')

@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Produk</a>
    </div>
</div>

<div class="card shadow-sm border-0 mb-5">
    <div class="row g-0">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start w-100" alt="{{ $product->name }}" style="object-fit: cover; max-height: 500px;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-start h-100 w-100" style="min-height: 400px;">
                    <i class="bi bi-image" style="font-size: 5rem;"></i>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-body p-5">
                <div class="mb-2">
                    <span class="badge bg-info text-dark">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                </div>
                
                <h1 class="card-title fw-bold mb-3">{{ $product->name }}</h1>
                <h2 class="text-primary fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                
                <div class="mb-4">
                    <h5 class="fw-semibold">Deskripsi Produk:</h5>
                    <p class="card-text text-muted" style="white-space: pre-line;">{{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}</p>
                </div>
                
                <div class="d-flex align-items-center mb-4">
                    <span class="fw-semibold me-3">Stok Tersedia:</span>
                    @if($product->stock > 0)
                        <span class="badge bg-success fs-6">{{ $product->stock }}</span>
                    @else
                        <span class="badge bg-danger fs-6">Habis</span>
                    @endif
                </div>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
