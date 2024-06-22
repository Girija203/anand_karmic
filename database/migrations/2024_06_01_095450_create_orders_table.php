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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_amount', 10, 2);
            $table->integer('product_qty');
            $table->string('payment_method')->nullable();
            $table->integer('payment_status')->default(0);
            $table->date('payment_approval_date')->nullable();
            $table->string('transection_id')->nullable();
            $table->string('shipping_method')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('coupon_cost', 10, 2)->default(0);
            $table->integer('order_status')->default(0);
            $table->date('order_approval_date')->nullable();
            $table->date('order_delivered_date')->nullable();
            $table->date('order_completed_date')->nullable();
            $table->date('order_declined_date')->nullable();
            $table->integer('delivery_man_id')->nullable();
            $table->integer('order_request')->nullable();
            $table->date('order_req_date')->nullable();
            $table->integer('cash_on_delivery')->nullable();
            $table->timestamps();
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
