<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->latest()->paginate(10);
        return view('pages.purchases.show', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $nextInvoice = 'INV-' . date('Ymd') . '-' . str_pad(Purchase::count() + 1, 4, '0', STR_PAD_LEFT);
        
        return view('pages.purchases.add', compact('suppliers', 'products', 'nextInvoice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Create Purchase
            $purchase = Purchase::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad(Purchase::count() + 1, 4, '0', STR_PAD_LEFT),
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
                'total_amount' => 0, // Will update below
                'notes' => $request->notes,
            ]);

            $totalAmount = 0;

            // Create Items & Update Stock
            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                $totalAmount += $subtotal;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal,
                ]);

                // AUTO-ADD STOCK
                $product = Product::find($item['product_id']);
                $product->stock += $item['quantity'];
                $product->save();
            }

            // Update total amount
            $purchase->update(['total_amount' => $totalAmount]);

            DB::commit();

            return redirect()->route('purchases.index')->with('success', 'Purchase saved successfully! Stock has been updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Purchase $purchase)
    {
        $purchase->load('supplier', 'items.product');
        return view('pages.purchases.view', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $purchase->load('items');
        return view('pages.purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        // Simplified update - just notes and date for now
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
        ]);
        
        $purchase->update($request->all());
        return redirect()->route('purchases.index')->with('success', 'Purchase updated!');
    }

    public function destroy(Purchase $purchase)
    {
        DB::beginTransaction();
        try {
            // Reverse the stock additions
            foreach ($purchase->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->stock -= $item->quantity;
                    $product->save();
                }
            }
            $purchase->delete();
            DB::commit();
            return redirect()->route('purchases.index')->with('success', 'Purchase deleted and stock reversed.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting purchase: ' . $e->getMessage());
        }
    }

    public function confirmDelete(Purchase $purchase)
    {
        $purchase->load('supplier');
        return view('pages.purchases.delete', compact('purchase'));
    }
}