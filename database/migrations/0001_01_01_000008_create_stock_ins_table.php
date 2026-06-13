<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items');
            $table->integer('quantity');
            $table->decimal('purchase_price', 12, 2);
            $table->decimal('total_price', 12, 2);
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->foreignId('user_id')->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_ins');
    }
};
