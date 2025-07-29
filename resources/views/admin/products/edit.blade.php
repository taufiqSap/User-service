@extends('layouts.app')

@section('content')
    <style>
        .gaming-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border-radius: 1rem;
            padding: 2rem;
        }

        .neon-button {
            background: linear-gradient(45deg, #00f5ff, #bf00ff);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 245, 255, 0.3);
            transition: all 0.3s ease;
            border: none;
        }

        .neon-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 245, 255, 0.5);
        }

        .input-style {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 0.75rem;
            width: 100%;
            color: white;
            border-radius: 0.5rem;
        }

        label {
            color: #ccc;
        }

        body {
            background: linear-gradient(135deg, #1b1b2f, #162447);
        }
    </style>

    <div class="gaming-card mx-auto max-w-xl">
        <h1 class="text-2xl font-bold text-white mb-6">Edit Produk</h1>
        <form action="{{ route('admin.products.update', $product['id']) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label>Nama Produk</label>
                <input type="text" name="name" class="input-style" value="{{ $product['name'] }}" required>
            </div>
            <div>
                <label>Harga</label>
                <input type="number" name="price" class="input-style" value="{{ $product['price'] }}" required>
            </div>
            <div>
                <label>Stok</label>
                <input type="number" name="stock" class="input-style" value="{{ $product['stock'] }}" required>
            </div>
            <div>
                <label>Deskripsi</label>
                <input type="text" name="description" class="input-style" value="{{ $product['description'] }}" required>
            </div>
            <div class="flex items-center">
                <button type="submit" class="neon-button">Update</button>
                <a href="{{ route('admin.products.index') }}" class="ml-4 text-gray-300 hover:underline">Batal</a>
            </div>
        </form>
    </div>
@endsection
