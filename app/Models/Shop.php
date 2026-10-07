<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'phone',
        'address',
        'manager_name',
        'is_active',
    ];

    public function stocks()
    {
        return $this->hasMany(ShopStock::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'shop_stocks')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function transfersFrom()
    {
        return $this->hasMany(StockTransfer::class, 'from_shop_id');
    }

    public function transfersTo()
    {
        return $this->hasMany(StockTransfer::class, 'to_shop_id');
    }

    // Helper: total batteries in this shop
    public function totalBatteries()
    {
        return $this->stocks()->sum('quantity');
    }
}