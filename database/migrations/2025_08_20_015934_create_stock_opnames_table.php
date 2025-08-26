<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('stock_opnames', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('system_stock');   // stok sistem
        $table->integer('real_stock');     // stok fisik hasil opname
        $table->integer('difference');     // selisih = real - sistem
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // siapa yg opname
        $table->text('note')->nullable();  // catatan opname
        $table->timestamps();
    });
}

};
