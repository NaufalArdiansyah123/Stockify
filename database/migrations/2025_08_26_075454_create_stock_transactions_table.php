<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('stock_transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->enum('type', ['in', 'out']);
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->unsignedBigInteger('approved_by')->nullable();
        $table->timestamps();
    });
}

};
