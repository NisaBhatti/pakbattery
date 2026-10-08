<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'category',
        'amount',
        'expense_date',
        'payment_method',
        'description',
    ];

    // Predefined categories
    public static function categories(): array
    {
        return [
            'Rent',
            'Utilities',
            'Salary',
            'Transport',
            'Maintenance',
            'Marketing',
            'Office Supplies',
            'Other',
        ];
    }
}