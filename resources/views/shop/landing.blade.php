@extends('layouts.shop')

@section('content')

<!-- Hero Section -->
<div class="p-5 mb-5 bg-light rounded-3 shadow-sm border text-center">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Selamat Datang di Wong Tulus</h1>
        <p class="col-md-8 mx-auto fs-4 text-muted">
            Temukan produk-produk terbaik dengan harga terjangkau. Belanja mudah, aman, dan terpercaya.
        </p>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mt-3">Mulai Belanja</a>
    </div>
</div>

<!-- Promotional Banner -->
<div class="alert alert-info shadow-sm mb-5 text-center" role="alert">
    <strong><i class="bi bi-megaphone-fill"></i> Promo Spesial!</strong> Dapatkan gratis ongkir untuk pembelian pertama Anda. Jangan lewatkan kesempatan ini!
</div>

<!-- Daftar Kategori Produk -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Kategori Pilihan</h3>
    </div>
    
    <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach($categories as $category)
            <div class="col">
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-decoration-none">
                    <div class="card h-100 text-center shadow-sm hover-overlay">
                        <div class="card-body py-4">
                            <i class="bi bi-tag text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title text-dark">{{ $category->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Produk Terbaru -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Produk Terbaru</h3>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($latestProducts as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center card-img-top" style="height: 200px;">
                            <i class="bi bi-image" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-2">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                        <h6 class="text-primary fw-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary mt-auto">Detail Produk</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">Belum ada produk.</h4>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-overlay:hover {
        background-color: #f8f9fa;
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
</style>

@endsection
