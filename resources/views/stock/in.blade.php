@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Barang Masuk</h1>
<form method="post" action="{{ route('stock.in.store') }}" class="bg-white p-4 rounded-xl shadow">@csrf
  <label class="block text-sm">Produk</label>
  <select name="product_id" class="border rounded w-full p-2 mb-3" required>
    @foreach($products as $p)<option value="{{ $p->id }}">{{ $p->code }} — {{ $p->name }}</option>@endforeach
  </select>
  <label class="block text-sm">Jumlah</label>
  <input type="number" name="quantity" class="border rounded w-full p-2 mb-3" min="1" required />
  <label class="block text-sm">Catatan</label>
  <input name="note" class="border rounded w-full p-2 mb-3" />
  <button class="px-3 py-2 bg-green-600 text-white rounded">Simpan</button>
</form>
@endsection
