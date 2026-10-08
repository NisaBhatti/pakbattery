<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use App\Models\ShopStock;
use App\Models\StockTransfer;       
use App\Models\StockTransferItem;   
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::withCount('stocks')->latest()->paginate(10);
        // Attach total batteries count to each shop
        $shops->each(function ($shop) {
            $shop->total_batteries = $shop->totalBatteries();
        });
        
        return view('pages.shops.show', compact('shops'));
    }

    public function create()
    {
        // Auto-generate next shop code
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
        $shop->load('stocks.product');
        $totalBatteries = $shop->totalBatteries();
        $totalProducts = $shop->stocks()->count();
        $lowStockCount = $shop->stocks()->where('quantity', '<=', 5)->count();
        
        return view('pages.shops.view', compact('shop', 'totalBatteries', 'totalProducts', 'lowStockCount'));
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

    /**
     * Show all batteries (products) across all shops with filters
     */
    public function batteries(Request $request)
    {
        $query = ShopStock::with('shop', 'product');

        // Filter by shop
        if ($request->filled('shop_id')) {
            $query->where('shop_id', $request->shop_id);
        }

        // Filter by product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        // Filter by stock level
        if ($request->filled('stock_level')) {
            if ($request->stock_level === 'low') {
                $query->where('quantity', '<=', 5);
            } elseif ($request->stock_level === 'medium') {
                $query->whereBetween('quantity', [6, 20]);
            } elseif ($request->stock_level === 'high') {
                $query->where('quantity', '>', 20);
            }
        }

        // Search by product name or plate
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('plate_number', 'like', "%{$search}%");
            });
        }

        $stocks = $query->latest()->paginate(15)->withQueryString();

        // Stats
        $totalBatteries = ShopStock::sum('quantity');
        $totalShops = Shop::count();
        $lowStockCount = ShopStock::where('quantity', '<=', 5)->count();

        $shops = Shop::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('pages.shops.batteries', compact(
            'stocks', 'shops', 'products',
            'totalBatteries', 'totalShops', 'lowStockCount'
        ));
    }

    /**
     * Show the "Send Stock" page
     */
    public function sendStockIndex(Request $request)
    {
        $query = StockTransfer::with('fromShop', 'toShop', 'items');

        // Filters
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

        // Stats for cards
        $totalBatteries = ShopStock::sum('quantity');
        $totalTransfers = StockTransfer::count();
        $totalTransferredQty = StockTransfer::sum('total_quantity');

        $shops = Shop::orderBy('name')->get();

        return view('pages.shops.send-stock', compact(
            'transfers', 'shops',
            'totalBatteries', 'totalTransfers', 'totalTransferredQty'
        ));
    }

    /**
     * Show the "Create Transfer" form
     */
    public function createTransfer()
    {
        $shops = Shop::where('is_active', true)->orderBy('name')->get();
        $nextTransferNumber = 'TRF-' . date('Ymd') . '-' . str_pad(StockTransfer::count() + 1, 4, '0', STR_PAD_LEFT);
        
        return view('pages.shops.create-transfer', compact('shops', 'nextTransferNumber'));
    }

    /**
     * Store a new stock transfer
     */
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

        // Check stock availability in source shop
        foreach ($request->items as $item) {
            $stock = ShopStock::where('shop_id', $request->from_shop_id)
                ->where('product_id', $item['product_id'])
                ->first();
            
            if (!$stock || $stock->quantity < $item['quantity']) {
                $product = Product::find($item['product_id']);
                $available = $stock ? $stock->quantity : 0;
                return back()->with('error', "Not enough stock for {$product->name}. Available: {$available}")
                    ->withInput();
            }
        }

        \DB::beginTransaction();
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

                \App\Models\StockTransferItem::create([
                    'stock_transfer_id' => $transfer->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);

                // Reduce from source shop
                $fromStock = ShopStock::where('shop_id', $request->from_shop_id)
                    ->where('product_id', $item['product_id'])
                    ->first();
                $fromStock->decrement('quantity', $item['quantity']);

                // Add to destination shop (create if not exists)
                $toStock = ShopStock::firstOrCreate(
                    ['shop_id' => $request->to_shop_id, 'product_id' => $item['product_id']],
                    ['quantity' => 0]
                );
                $toStock->increment('quantity', $item['quantity']);
            }

            $transfer->update(['total_quantity' => $totalQty]);

            \DB::commit();
            return redirect()->route('shops.send-stock')->with('success', 'Stock transferred successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Transfer failed: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * View a single transfer
     */
    public function viewTransfer(StockTransfer $transfer)
    {
        $transfer->load('fromShop', 'toShop', 'items.product');
        return view('pages.shops.view-transfer', compact('transfer'));
    }
}