<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('customer')->latest()->paginate(10);
        return view('pages.bills.show', compact('bills'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $products = Product::where('stock', '>', 0)->orderBy('name')->get();
        $nextBill = 'BILL-' . date('Ymd') . '-' . str_pad(Bill::count() + 1, 4, '0', STR_PAD_LEFT);
        
        return view('pages.bills.add', compact('customers', 'products', 'nextBill'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'bill_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Check stock availability
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Not enough stock for {$product->name}. Available: {$product->stock}")
                    ->withInput();
            }
        }

        DB::beginTransaction();
        try {
            $bill = Bill::create([
                'bill_number' => 'BILL-' . date('Ymd') . '-' . str_pad(Bill::count() + 1, 4, '0', STR_PAD_LEFT),
                'customer_id' => $request->customer_id,
                'bill_date' => $request->bill_date,
                'total_amount' => 0,
                'notes' => $request->notes,
            ]);

            $totalAmount = 0;

            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['unit_price'];
                $totalAmount += $subtotal;

                BillItem::create([
                    'bill_id' => $bill->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal,
                ]);

                // AUTO-REDUCE STOCK
                $product = Product::find($item['product_id']);
                $product->stock -= $item['quantity'];
                $product->save();
            }

            $bill->update(['total_amount' => $totalAmount]);

            DB::commit();

            return redirect()->route('bills.index')->with('success', 'Bill saved successfully! Stock has been reduced.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Bill $bill)
    {
        $bill->load('customer', 'items.product');
        return view('pages.bills.view', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $customers = Customer::orderBy('name')->get();
        $bill->load('items');
        return view('pages.bills.edit', compact('bill', 'customers'));
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'bill_date' => 'required|date',
        ]);
        
        $bill->update($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill updated!');
    }

    public function destroy(Bill $bill)
    {
        DB::beginTransaction();
        try {
            // Reverse stock reductions
            foreach ($bill->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->stock += $item->quantity;
                    $product->save();
                }
            }
            $bill->delete();
            DB::commit();
            return redirect()->route('bills.index')->with('success', 'Bill deleted and stock restored.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting bill: ' . $e->getMessage());
        }
    }

    public function confirmDelete(Bill $bill)
    {
        $bill->load('customer');
        return view('pages.bills.delete', compact('bill'));
    }
}