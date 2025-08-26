<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Produk</h1>
    <p><strong>Nama:</strong> {{ $product->name }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    <p><strong>Stok:</strong> {{ $product->stock }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection -->
