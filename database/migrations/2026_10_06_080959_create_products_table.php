<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product Name
            $table->string('plate_number')->unique(); // Plate/Serial Number
            $table->decimal('price', 10, 2)->default(0); // Selling Price
            $table->integer('stock')->default(0); // Current Stock Quantity
            $table->timestamps();
            $table->softDeletes(); // Keep records safe for accounting
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};