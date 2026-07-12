@extends('layouts.shop')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="mb-4">Daftar Produk</h2>
        
        <form action="{{ url('/') }}" method="GET" class="card card-body bg-white shadow-sm mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="q" class="form-label">Cari Produk</label>
                    <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Masukkan nama produk...">
                </div>
                <div class="col-md-5">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($products as $product)
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
            <h4 class="text-muted">Produk tidak ditemukan.</h4>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Reset Pencarian</a>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-5">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection
