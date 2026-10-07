<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transfer_number',
        'from_shop_id',
        'to_shop_id',
        'transfer_date',
        'notes',
        'total_quantity',
    ];

    public function fromShop()
    {
        return $this->belongsTo(Shop::class, 'from_shop_id');
    }

    public function toShop()
    {
        return $this->belongsTo(Shop::class, 'to_shop_id');
    }

    public function items()
    {
        return $this->hasMany(StockTransferItem::class);
    }
}