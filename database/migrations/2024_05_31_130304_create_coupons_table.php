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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_type_id');
            $table->string('name');
            $table->string('code');
             $table->enum('discount_type', ['percentage', 'fixed']);
             $table->decimal('discount_value', 10, 2);
             $table->date('start_date');
             $table->date('end_date');
             $table->decimal('minimum_purchase_price', 10, 2)->default(0.00);
             $table->integer('usage_limit')->nullable();
             $table->integer('usage_count')->default(0);
             $table->boolean('status')->default(1);
            $table->foreign('coupon_type_id')->references('id')->on('coupon_types')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
