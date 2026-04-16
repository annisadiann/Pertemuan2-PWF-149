<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate; // Wajib diimport untuk Modul 5

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        // Modul 5: Otorisasi Gate
        Gate::authorize('manage-product');

        $products = Product::with('user')->paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Menyimpan produk baru (Modul 6: Validasi)
     */
    public function store(Request $request)
    {
        // Modul 5: Pastikan yang simpan adalah admin
        Gate::authorize('manage-product');

        // Modul 6: Implementasi Validasi Store
        $validated = $request->validate([
            'name'     => 'required|string|min:3|max:255',
            'quantity' => 'required|integer|min:1',
            'price'    => 'required|numeric|min:1000',
        ], [
            // Pesan error custom agar lebih informatif untuk user
            'name.required' => 'Nama produk tidak boleh kosong!',
            'price.min'     => 'Harga produk minimal Rp 1.000',
        ]);

        // Menambahkan user_id pemilik produk
        $validated['user_id'] = auth()->id();

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Halaman form tambah produk
     */
    public function create()
    {
        Gate::authorize('manage-product');

        $users = User::orderBy('name')->get();
        return view('product.create', compact('users'));
    }

    /**
     * Menampilkan detail produk
     */
    public function show($id)
    {
        Gate::authorize('manage-product');

        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    /**
     * Memperbarui data produk (Modul 5 & 6)
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Modul 5: Otorisasi Policy (Hanya Admin pemilik data yang bisa edit)
        $this->authorize('update', $product);

        // Modul 6: Implementasi Validasi Update
        $validated = $request->validate([
            'name'     => 'required|string|min:3|max:255',
            'quantity' => 'required|integer|min:1',
            'price'    => 'required|numeric|min:1000',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Halaman form edit produk
     */
    public function edit(Product $product)
    {
        // Modul 5: Otorisasi Policy
        $this->authorize('update', $product);

        $users = User::orderBy('name')->get();
        return view('product.edit', compact('product', 'users'));
    }

    /**
     * Menghapus produk
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Modul 5: Otorisasi Policy
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    /**
     * Export data ke Excel (Penugasan B)
     */
    public function export()
    {
        // Modul 5: Gate khusus export
        Gate::authorize('export-product');

        return Excel::download(new ProductExport, 'products.xlsx');
    }
}