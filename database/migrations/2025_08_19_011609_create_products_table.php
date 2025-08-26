<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->default('N/A');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->decimal('price_buy', 12, 2)->default(0);
            $table->decimal('price_sell', 12, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('stock_minimum')->default(0);
            $table->json('attributes')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index(['name', 'code']); // Index untuk pencarian
            $table->index('category_id');
            $table->index('supplier_id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
