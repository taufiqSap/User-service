<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        try {
        
            $response = Http::timeout(10)->get('http://127.0.0.1:8002/api/transactions');

            if (!$response->successful()) {
                return view('admin.transactions.index', [
                    'transactions' => [],
                    'error' => 'Gagal mengambil data: ' . $response->status()
                ]);
            }

            $json = $response->json();
            
            // Debug sementara - cek struktur data
            \Log::info('API Response:', $json);
            
            // Cek apakah ada key 'data' atau langsung array
            $transactions = [];
            if (isset($json['data']) && is_array($json['data'])) {
                $transactions = $json['data'];
            } elseif (is_array($json)) {
                $transactions = $json;
            }

            return view('admin.transactions.index', compact('transactions'));

        } catch (\Exception $e) {
            \Log::error('Transaction API Error: ' . $e->getMessage());
            
            return view('admin.transactions.index', [
                'transactions' => [],
                'error' => 'data transaksi tidak ada'
            ]);
        }
    }
}