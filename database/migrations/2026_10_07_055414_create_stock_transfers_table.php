<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_number')->unique(); // e.g., TRF-20241007-0001
            $table->foreignId('from_shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('to_shop_id')->constrained('shops')->onDelete('cascade');
            $table->date('transfer_date');
            $table->text('notes')->nullable();
            $table->integer('total_quantity')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};