@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1a1c2c, #342e5c);
        color: #fff;
    }

    .gaming-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .neon-button {
        background: linear-gradient(45deg, #00f5ff, #bf00ff);
        box-shadow: 0 4px 15px rgba(0, 245, 255, 0.3);
        transition: all 0.3s ease;
        color: #fff;
    }

    .neon-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 245, 255, 0.5);
    }

    .cancel-button {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ddd;
        transition: all 0.3s ease;
    }

    .cancel-button:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .form-input {
        background-color: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    label {
        color: #ddd;
    }
</style>

<div class="max-w-2xl mx-auto py-10 px-6">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-white mb-2">Tambah Produk</h1>
        <p class="text-gray-300">Isi form untuk menambahkan produk ke sistem</p>
    </div>

    <!-- Form Card -->
    <div class="rounded-xl gaming-card p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Produk -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    class="w-full px-3 py-2 rounded-md focus:outline-none form-input"
                    placeholder="Masukkan nama produk"
                    required
                >
            </div>

            <!-- Harga dan Stok -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="price" 
                        class="w-full px-3 py-2 rounded-md focus:outline-none form-input"
                        placeholder="0"
                        min="0"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="stock" 
                        class="w-full px-3 py-2 rounded-md focus:outline-none form-input"
                        placeholder="0"
                        min="0"
                        required
                    >
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Deskripsi
                </label>
                <textarea 
                    name="description" 
                    rows="4" 
                    class="w-full px-3 py-2 rounded-md focus:outline-none form-input resize-none"
                    placeholder="Masukkan deskripsi produk (opsional)"
                ></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-600">
                <button 
                    type="submit" 
                    class="neon-button py-2 px-4 rounded-md text-center"
                >
                    Simpan Produk
                </button>

                <a 
                    href="{{ route('admin.products.index') }}" 
                    class="cancel-button py-2 px-4 rounded-md text-center inline-block"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
