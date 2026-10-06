<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Shows the main table (show.blade.php)
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('pages.products.show', compact('products'));
    }

    // Shows the add form (add.blade.php)
    public function create()
    {
        return view('pages.products.add');
    }

    // Saves the new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:products,plate_number',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Shows a single product (view.blade.php)
    public function show(Product $product)
    {
        return view('pages.products.view', compact('product'));
    }

    // Shows the edit form (edit.blade.php)
    public function edit(Product $product)
    {
        return view('pages.products.edit', compact('product'));
    }

    // Updates the product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:products,plate_number,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Shows the delete confirmation (delete.blade.php)
    public function destroy(Product $product)
    {
        // Note: We will change the route to show a confirmation page first.
        // For now, this handles the actual deletion after confirmation.
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
    
    // Optional: Add a method to show the delete confirmation page
    public function confirmDelete(Product $product)
    {
        return view('pages.products.delete', compact('product'));
    }
}