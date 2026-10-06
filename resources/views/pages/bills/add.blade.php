@extends('Layout.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #1e293b;">Create New Bill</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Create a new customer bill. Stock will reduce automatically.</p>
        </div>
        <a href="{{ route('bills.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 10px 20px;">
            <i class="ph ph-arrow-left me-1"></i> Back to List
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b;">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm" role="alert" style="border-radius: 12px; background-color: #fef2f2; color: #991b1b;">
            <i class="ph-fill ph-warning-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('bills.store') }}" method="POST" id="billForm">
        @csrf
        
        <!-- Top Info Card -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Bill Number</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-receipt"></i></span>
                            <input type="text" class="form-control bg-light border-0" value="{{ $nextBill }}" readonly style="border-radius: 0 12px 12px 0; font-weight: 600; color: #4f46e5;">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Customer <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-user"></i></span>
                            <select name="customer_id" class="form-select bg-light border-0" required style="border-radius: 0 12px 12px 0;">
                                <option value="">-- Select Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} {{ $customer->phone ? '(' . $customer->phone . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Bill Date <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="ph ph-calendar"></i></span>
                            <input type="date" name="bill_date" class="form-control bg-light border-0" value="{{ old('bill_date', date('Y-m-d')) }}" required style="border-radius: 0 12px 12px 0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Card -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0" style="color: #1e293b;">
                    <i class="ph ph-package text-primary me-2"></i> Products Sold
                </h5>
                <button type="button" class="btn btn-primary fw-bold" id="addRowBtn" style="background: #4f46e5; border: none; padding: 10px 20px; border-radius: 10px;">
                    <i class="ph ph-plus-circle me-1"></i> Add Product Row
                </button>
            </div>
            
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle" id="itemsTable">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th class="text-muted fw-semibold py-3 ps-4" style="border-radius: 10px 0 0 10px; width: 35%;">Product</th>
                                <th class="text-muted fw-semibold py-3 text-center" style="width: 15%;">Quantity</th>
                                <th class="text-muted fw-semibold py-3 text-end" style="width: 20%;">Unit Price</th>
                                <th class="text-muted fw-semibold py-3 text-end" style="width: 20%;">Subtotal</th>
                                <th class="text-muted fw-semibold py-3 pe-4 text-center" style="border-radius: 0 10px 10px 0; width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemsBody"></tbody>
                    </table>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <div class="p-4 rounded" style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-white-50 fw-semibold">Items Count:</span>
                                <span class="text-white fw-bold" id="itemsCount">0</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center" style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 12px;">
                                <span class="text-white fw-bold" style="font-size: 1.1rem;">GRAND TOTAL:</span>
                                <h3 class="text-white fw-bold mb-0" id="grandTotal">$0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <label class="form-label fw-semibold text-muted" style="font-size: 0.9rem;">Notes</label>
                <textarea name="notes" class="form-control bg-light border-0" rows="3" placeholder="Optional notes about this bill..." style="border-radius: 12px;">{{ old('notes') }}</textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('bills.index') }}" class="btn btn-light border fw-bold" style="border-radius: 10px; padding: 12px 30px;">Cancel</a>
            <button type="submit" class="btn btn-primary fw-bold" style="background: #4f46e5; border: none; padding: 12px 40px; border-radius: 10px; font-size: 1.05rem;">
                <i class="ph ph-floppy-disk me-1"></i> Save Bill & Reduce Stock
            </button>
        </div>
    </form>
</div>

<script id="productsData" type="application/json">
    {!! json_encode($products->map(function($p) {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'plate_number' => $p->plate_number,
            'price' => (float) $p->price,
            'stock' => (int) $p->stock
        ];
    })) !!}
</script>

<style>
    .input-group-text { border-radius: 12px 0 0 12px !important; padding-left: 18px; padding-right: 12px; }
    .form-control, .form-select { padding: 14px 18px; font-size: 1rem; transition: all 0.2s ease-in-out; box-shadow: none !important; }
    .form-control:focus, .form-select:focus { background-color: #ffffff !important; box-shadow: 0 0 0 4px #eef2ff !important; border: 1px solid #4f46e5 !important; }
    .input-group-text i { font-size: 1.2rem; }
    .item-row { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .btn-delete-row { width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; border: 1px solid #fee2e2; background: #fef2f2; color: #ef4444; transition: all 0.2s; font-size: 1.2rem; }
    .btn-delete-row:hover { background: #ef4444; color: white; }
    .product-details { display: flex; gap: 8px; font-size: 0.75rem; color: #94a3b8; margin-top: 4px; }
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const products = JSON.parse(document.getElementById('productsData').textContent);
    const tbody = document.getElementById('itemsBody');
    let rowCounter = 0;

    function buildProductOptions() {
        let options = '<option value="">-- Search & Select Product --</option>';
        products.forEach(p => {
            options += `<option value="${p.id}">${p.name} (${p.plate_number}) - Stock: ${p.stock}</option>`;
        });
        return options;
    }

    function addRow() {
        rowCounter++;
        const rowId = 'row-' + rowCounter;
        const row = document.createElement('tr');
        row.className = 'item-row';
        row.id = rowId;
        row.style.borderBottom = '1px solid #f1f5f9';
        
        row.innerHTML = `
            <td class="ps-4">
                <select name="items[${rowCounter}][product_id]" class="form-select product-select" required style="border-radius: 10px; font-size: 0.9rem; padding: 10px 14px;">
                    ${buildProductOptions()}
                </select>
                <div class="product-details"></div>
            </td>
            <td class="text-center">
                <input type="number" name="items[${rowCounter}][quantity]" class="form-control quantity-input text-center" value="1" min="1" required style="border-radius: 10px; font-size: 0.95rem; padding: 10px; font-weight: 600;">
            </td>
            <td class="text-end">
                <input type="number" step="0.01" name="items[${rowCounter}][unit_price]" class="form-control price-input text-end" value="0.00" min="0" required style="border-radius: 10px; font-size: 0.95rem; padding: 10px; font-weight: 600;">
            </td>
            <td class="text-end">
                <span class="subtotal fw-bold" style="color: #10b981; font-size: 1.05rem;">$0.00</span>
            </td>
            <td class="text-center pe-4">
                <button type="button" class="btn-delete-row" onclick="removeRow('${rowId}')" title="Remove">
                    <i class="ph ph-trash"></i>
                </button>
            </td>
        `;
        
        tbody.appendChild(row);
        updateTotals();
    }

    window.removeRow = function(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            if (tbody.children.length <= 1) {
                alert('At least one product row is required.');
                return;
            }
            row.remove();
            updateTotals();
        }
    };

    function updateTotals() {
        let grandTotal = 0;
        let itemCount = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const qty = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const subtotal = qty * price;
            row.querySelector('.subtotal').textContent = '$' + subtotal.toFixed(2);
            if (qty > 0) {
                grandTotal += subtotal;
                itemCount++;
            }
        });
        document.getElementById('grandTotal').textContent = '$' + grandTotal.toFixed(2);
        document.getElementById('itemsCount').textContent = itemCount;
    }

    tbody.addEventListener('input', function(e) {
        if (e.target.classList.contains('quantity-input') || e.target.classList.contains('price-input')) {
            updateTotals();
        }
    });

    tbody.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select')) {
            const row = e.target.closest('.item-row');
            const productId = e.target.value;
            const priceInput = row.querySelector('.price-input');
            const detailsDiv = row.querySelector('.product-details');
            
            if (productId) {
                const product = products.find(p => p.id == productId);
                if (product) {
                    priceInput.value = product.price.toFixed(2);
                    detailsDiv.innerHTML = `<span><i class="ph ph-stack"></i> Available Stock: <strong>${product.stock}</strong></span>`;
                }
            } else {
                priceInput.value = '0.00';
                detailsDiv.innerHTML = '';
            }
            updateTotals();
        }
    });

    addRow();
    document.getElementById('addRowBtn').addEventListener('click', addRow);

    document.getElementById('billForm').addEventListener('submit', function(e) {
        const rows = document.querySelectorAll('.item-row');
        let valid = true;
        
        rows.forEach(row => {
            const productSelect = row.querySelector('.product-select');
            const qty = parseFloat(row.querySelector('.quantity-input').value) || 0;
            
            if (!productSelect.value || qty < 1) {
                valid = false;
            } else {
                // Check stock
                const productId = productSelect.value;
                const product = products.find(p => p.id == productId);
                if (product && qty > product.stock) {
                    alert(`Not enough stock for ${product.name}. Available: ${product.stock}, Requested: ${qty}`);
                    valid = false;
                }
            }
        });
        
        if (!valid) {
            e.preventDefault();
            return false;
        }
        
        return confirm('Save this bill? Stock will be reduced from selected products.');
    });
});
</script>
@endpush