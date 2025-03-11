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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->date('date_movement');
            $table->enum('type', ["entrada","salida","ajuste"]);
            $table->integer('amount');
            $table->string('note', 255);

            $table->unsignedBigInteger("order_id")->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("product_supplier_id")->nullable();
            $table->foreign('product_supplier_id')->references('id')->on('product_suppliers')->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("warehouse_id");
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate("cascade");

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
