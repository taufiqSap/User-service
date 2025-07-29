<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $baseUrl = 'http://127.0.0.1:8001/api/products';

   public function index()
    {
        try {
        
            $response = Http::timeout(10)->get('http://127.0.0.1:8001/api/products');

            if (!$response->successful()) {
                return view('admin.products.index', [
                    'products' => [],
                    'error' => 'Gagal mengambil data: ' . $response->status()
                ]);
            }

            $json = $response->json();
            
            // Debug sementara - cek struktur data
            \Log::info('API Response:', $json);
            
            // Cek apakah ada key 'data' atau langsung array
            $products = [];
            if (isset($json['data']) && is_array($json['data'])) {
                $products = $json['data'];
            } elseif (is_array($json)) {
                $products = $json;
            }

            return view('admin.products.index', compact('products'));

        } catch (\Exception $e) {
            \Log::error('Transaction API Error: ' . $e->getMessage());
            
            return view('admin.products.index', [
                'products' => [],
                'error' => 'data produk tidak ada'
            ]);
        }
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $response = Http::post($this->baseUrl, $request->only('name', 'price','stock','de'));

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $response = Http::get("{$this->baseUrl}/$id");
        $product = $response->successful() ? $response->json() : abort(404);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $data = $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'description' => 'nullable|string'
    ]);

    $response = Http::put("http://127.0.0.1:8001/api/products/{$id}", $data);

    if ($response->successful()) {
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    return back()->withErrors(['msg' => 'Gagal mengupdate produk']);
}

    public function destroy($id)
    {
        Http::delete("{$this->baseUrl}/$id");

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
