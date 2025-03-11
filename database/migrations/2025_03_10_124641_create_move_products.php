<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('move_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate("cascade");

            $table->integer('amount');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("from_warehouse_id");
            $table->foreign('from_warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("until_warehouse_id");
            $table->foreign('until_warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_products');
    }
};
