@extends('layouts.shop')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold"><i class="bi bi-cart3"></i> Keranjang Belanja</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($cartItems->count() > 0)
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">Gambar</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th style="width: 160px;">Quantity</th>
                        <th>Subtotal</th>
                        <th style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('product.show', $item->product->id) }}" class="text-decoration-none fw-semibold">
                                    {{ $item->product->name }}
                                </a>
                                <br>
                                <small class="text-muted">{{ $item->product->category->name ?? 'Tanpa Kategori' }}</small>
                            </td>
                            <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm" style="width: 80px;">
                                    <button type="submit" class="btn btn-sm btn-outline-primary" title="Update">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4" class="text-end fw-bold fs-5">Total:</td>
                        <td colspan="2" class="fw-bold fs-5 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Lanjut Belanja
        </a>
        <a href="#" class="btn btn-primary">
            <i class="bi bi-credit-card"></i> Checkout
        </a>
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
        <h4 class="text-muted mt-3">Keranjang Anda kosong.</h4>
        <p class="text-muted">Belum ada produk di keranjang belanja Anda.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
            <i class="bi bi-shop"></i> Mulai Belanja
        </a>
    </div>
@endif
@endsection
