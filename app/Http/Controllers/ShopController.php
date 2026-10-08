<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use App\Models\StockTransfer;
use App\Models\StockTransferItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    // ==================== SHOPS CRUD ====================
    
    public function index()
    {
        $shops = Shop::latest()->paginate(10);
        return view('pages.shops.show', compact('shops'));
    }

    public function create()
    {
        $nextCode = 'SHOP-' . str_pad(Shop::count() + 1, 3, '0', STR_PAD_LEFT);
        return view('pages.shops.add', compact('nextCode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:shops,code',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'manager_name' => 'nullable|string|max:255',
        ]);

        Shop::create($request->all());

        return redirect()->route('shops.index')->with('success', 'Shop added successfully!');
    }

    public function show(Shop $shop)
    {
        // Get all transfers where this shop was the destination
        $receivedTransfers = StockTransfer::with('fromShop', 'items.product')
            ->where('to_shop_id', $shop->id)
            ->latest()
            ->get();

        // Get all transfers where this shop was the source
        $sentTransfers = StockTransfer::with('toShop', 'items.product')
            ->where('from_shop_id', $shop->id)
            ->latest()
            ->get();

        // Group received stock by product (sum quantities)
        $stockInShop = [];
        foreach ($receivedTransfers as $transfer) {
            foreach ($transfer->items as $item) {
                $productId = $item->product_id;
                if (!isset($stockInShop[$productId])) {
                    $stockInShop[$productId] = [
                        'product' => $item->product,
                        'quantity' => 0,
                    ];
                }
                $stockInShop[$productId]['quantity'] += $item->quantity;
            }
        }

        // Also subtract what was sent OUT from this shop
        foreach ($sentTransfers as $transfer) {
            foreach ($transfer->items as $item) {
                $productId = $item->product_id;
                if (isset($stockInShop[$productId])) {
                    $stockInShop[$productId]['quantity'] -= $item->quantity;
                }
            }
        }

        // Remove items with 0 or negative quantity
        $stockInShop = array_filter($stockInShop, fn($s) => $s['quantity'] > 0);

        $totalBatteries = collect($stockInShop)->sum('quantity');
        $totalProducts = count($stockInShop);
        $lowStockCount = collect($stockInShop)->where('quantity', '<=', 5)->count();

        return view('pages.shops.view', compact(
            'shop', 'stockInShop', 'totalBatteries', 'totalProducts', 'lowStockCount'
        ));
    }

    public function edit(Shop $shop)
    {
        return view('pages.shops.edit', compact('shop'));
    }

    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:shops,code,' . $shop->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'manager_name' => 'nullable|string|max:255',
        ]);

        $shop->update($request->all());

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully!');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Shop deleted successfully!');
    }

    public function confirmDelete(Shop $shop)
    {
        return view('pages.shops.delete', compact('shop'));
    }

    // ==================== BATTERIES OVERVIEW ====================
    
    public function batteries(Request $request)
    {
        // Get all products with their current master stock
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('plate_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('product_id')) {
            $query->where('id', $request->product_id);
        }

        if ($request->filled('stock_level')) {
            if ($request->stock_level === 'low') {
                $query->where('stock', '<=', 5);
            } elseif ($request->stock_level === 'medium') {
                $query->whereBetween('stock', [6, 20]);
            } elseif ($request->stock_level === 'high') {
                $query->where('stock', '>', 20);
            }
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        $totalBatteries = Product::sum('stock');
        $totalShops = Shop::count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        $shops = Shop::orderBy('name')->get();
        $allProducts = Product::orderBy('name')->get();

        return view('pages.shops.batteries', compact(
            'products', 'shops', 'allProducts',
            'totalBatteries', 'totalShops', 'lowStockCount'
        ));
    }

    // ==================== SEND STOCK ====================
    
    public function sendStockIndex(Request $request)
    {
        $query = StockTransfer::with('fromShop', 'toShop', 'items');

        if ($request->filled('from_shop_id')) {
            $query->where('from_shop_id', $request->from_shop_id);
        }
        if ($request->filled('to_shop_id')) {
            $query->where('to_shop_id', $request->to_shop_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('transfer_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('transfer_date', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $query->where('transfer_number', 'like', "%{$request->search}%");
        }

        $transfers = $query->latest()->paginate(15)->withQueryString();

        $totalBatteries = Product::sum('stock');
        $totalTransfers = StockTransfer::count();
        $totalTransferredQty = StockTransfer::sum('total_quantity');

        $shops = Shop::orderBy('name')->get();

        return view('pages.shops.send-stock', compact(
            'transfers', 'shops',
            'totalBatteries', 'totalTransfers', 'totalTransferredQty'
        ));
    }

    public function createTransfer()
    {
        $shops = Shop::orderBy('name')->get();
        $nextTransferNumber = 'TRF-' . date('Ymd') . '-' . str_pad(StockTransfer::count() + 1, 4, '0', STR_PAD_LEFT);
        
        return view('pages.shops.create-transfer', compact('shops', 'nextTransferNumber'));
    }

    public function storeTransfer(Request $request)
    {
        $request->validate([
            'from_shop_id' => 'required|exists:shops,id',
            'to_shop_id' => 'required|exists:shops,id|different:from_shop_id',
            'transfer_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Check master product stock
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return back()->with('error', "Product not found.")->withInput();
            }
            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Not enough stock for {$product->name}. Available: {$product->stock}, Requested: {$item['quantity']}")
                    ->withInput();
            }
        }

        DB::beginTransaction();
        try {
            $totalQty = 0;
            
            $transfer = StockTransfer::create([
                'transfer_number' => 'TRF-' . date('Ymd') . '-' . str_pad(StockTransfer::count() + 1, 4, '0', STR_PAD_LEFT),
                'from_shop_id' => $request->from_shop_id,
                'to_shop_id' => $request->to_shop_id,
                'transfer_date' => $request->transfer_date,
                'notes' => $request->notes,
                'total_quantity' => 0,
            ]);

            foreach ($request->items as $item) {
                $totalQty += $item['quantity'];

                StockTransferItem::create([
                    'stock_transfer_id' => $transfer->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);

                // DEDUCT from master product stock
                $product = Product::find($item['product_id']);
                $product->decrement('stock', $item['quantity']);
            }

            $transfer->update(['total_quantity' => $totalQty]);

            DB::commit();
            return redirect()->route('shops.send-stock')->with('success', 'Stock transferred successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transfer failed: ' . $e->getMessage())->withInput();
        }
    }

    public function viewTransfer(StockTransfer $transfer)
    {
        $transfer->load('fromShop', 'toShop', 'items.product');
        return view('pages.shops.view-transfer', compact('transfer'));
    }

    // ==================== API: Get All Products with Stock ====================
    
    public function productsJson()
    {
        $products = Product::where('stock', '>', 0)
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'plate_number' => $product->plate_number,
                    'quantity' => $product->stock,
                ];
            });

        return response()->json($products);
    }
}