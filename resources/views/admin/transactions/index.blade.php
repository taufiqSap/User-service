@extends('layouts.app')

@section('content')
<style>
    .gaming-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .gaming-table {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.08));
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .table-header {
        background: linear-gradient(135deg, rgba(103, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table-row {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }

    .table-row:hover {
        background: rgba(103, 126, 234, 0.1);
        transform: translateX(4px);
    }
</style>

<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="gaming-card rounded-2xl p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">📄 Daftar Transaksi</h1>
                <p class="text-gray-300">Lihat semua transaksi yang telah dilakukan</p>
            </div>
        </div>
    </div>

  <!-- @if(isset($error))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ $error }}
        </div>
    @endif-->

    <!-- Table -->
    <div class="gaming-table rounded-2xl overflow-hidden">
        <div class="table-header px-6 py-4">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Data Transaksi
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="table-header text-left text-sm font-semibold text-gray-200">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nama Customer</th>
                        <th class="px-6 py-4">Nomor HP</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Bayar</th>
                        <th class="px-6 py-4">Kembalian</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $trx)
                        <tr class="table-row">
                            <td class="px-6 py-4 text-white">{{ $trx['id'] }}</td>
                            <td class="px-6 py-4 text-white">{{ $trx['customer_name'] }}</td>
                            <td class="px-6 py-4 text-white">{{ $trx['customer_phone'] }}</td>
                            <td class="px-6 py-4 text-green-400 font-semibold">Rp {{ number_format($trx['total_price']) }}</td>
                            <td class="px-6 py-4 text-blue-400">Rp {{ number_format($trx['amount_paid']) }}</td>
                            <td class="px-6 py-4 text-yellow-300">Rp {{ number_format($trx['amount_paid'] - $trx['total_price']) }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ \Carbon\Carbon::parse($trx['created_at'])->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-200">
                                    @if(isset($trx['items']) && is_array($trx['items']))
                                        @foreach ($trx['items'] as $item)
                                            <div class="mb-1 p-2 bg-white/5 border border-white/10 rounded">
                                                <strong class="text-white">{{ $item['product_name'] ?? 'N/A' }}</strong><br>
                                                <small class="text-gray-400">
                                                    Qty: {{ $item['quantity'] ?? 0 }} × Rp {{ number_format($item['subtotal'] ?? 0) }}
                                                </small>
                                            </div>
                                        @endforeach
                                    @elseif(isset($trx['transaction_items']) && is_array($trx['transaction_items']))
                                        @foreach ($trx['transaction_items'] as $item)
                                            <div class="mb-1 p-2 bg-white/5 border border-white/10 rounded">
                                                <strong class="text-white">{{ $item['product_name'] ?? $item['name'] ?? 'N/A' }}</strong><br>
                                                <small class="text-gray-400">
                                                    Qty: {{ $item['quantity'] ?? 0 }} × Rp {{ number_format($item['price'] ?? 0) }} = Rp {{ number_format($item['subtotal'] ?? ($item['quantity'] * $item['price'])) }}
                                                </small>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-gray-500 italic">
                                            <small>Data produk tidak tersedia</small><br>
                                            <small class="text-xs">Debug: {{ json_encode(array_keys($trx)) }}</small>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-400">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
