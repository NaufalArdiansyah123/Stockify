@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        {{-- Header --}}
        <div class="bg-white p-6 shadow-lg">
            <h2 class="text-4xl font-bold text-black text-center">Detail Produk</h2>
            <hr class="border-t-2 border-gray-300 my-2">
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-10">
            
            {{-- Bagian Gambar --}}
            <div class="flex justify-center items-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full max-w-md rounded-xl shadow-2xl border transition-transform transform hover:scale-105">
                @else
                    <div class="w-full max-w-md h-80 flex items-center justify-center bg-gray-200 text-gray-400 rounded-xl border">
                        <img src="{{ asset('images/placeholder.png') }}" alt="Placeholder" class="h-32">
                    </div>
                @endif
            </div>

            {{-- Bagian Informasi --}}
            <div class="flex flex-col justify-between">
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-3">{{ $product->name }}</h3>
                    
                    {{-- Kategori --}}
                    <span class="inline-block bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm font-medium mb-4">
                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                    </span>

                    {{-- Harga --}}
                    <p class="text-4xl font-extrabold text-yellow-600 mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    {{-- Informasi Tambahan dalam Card --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-100 rounded-lg shadow-lg flex items-center border border-gray-300 transition-transform transform hover:scale-105">
                            <i class="fas fa-box text-gray-600 mr-2"></i>
                            <div>
                                <p class="text-gray-500 text-sm">Stock</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $product->stock }}</p>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-100 rounded-lg shadow-lg flex items-center border border-gray-300 transition-transform transform hover:scale-105">
                            <i class="fas fa-tag text-gray-600 mr-2"></i>
                            <div>
                                <p class="text-gray-500 text-sm">Kode Produk</p>
                                <p class="text-lg font-semibold text-gray-800">#{{ $product->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-8 flex gap-3">
                    <a href="{{ route('products.index') }}" 
                       class="px-5 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                        ← Kembali
                    </a>
                    <a href="{{ route('products.edit', $product->id) }}" 
                       class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection