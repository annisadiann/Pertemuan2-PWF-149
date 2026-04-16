<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate; // WAJIB DIIMPORT

class ProductController extends Controller
{
    public function index()
    {
        // Pengecekan Gate manage-product agar route index aman
        Gate::authorize('manage-product');

        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-product');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $validated['user_id'] = auth()->id();

        Product::create($validated);
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function create()
    {
        Gate::authorize('manage-product');

        $users = User::orderBy('name')->get();
        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        Gate::authorize('manage-product');
        
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Penugasan Praktikum: Menggunakan Policy untuk update
        // Hanya admin dan pemilik data yang bisa edit
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
        ]);
        
        $product->update($validated);
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        // Penugasan Praktikum: Menggunakan Policy untuk edit
        $this->authorize('update', $product);

        $users = User::orderBy('name')->get();
        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        
        // Penugasan Praktikum: Menggunakan Policy untuk delete
        $this->authorize('delete', $product);

        $product->delete();
        return redirect()->route('product.index')->with('success','Product berhasil dihapus');
    }

    public function export()
    {
        // Penugasan B: Menggunakan Gate export-product
        Gate::authorize('export-product');

        return Excel::download(new ProductExport, 'products.xlsx');
    }
}