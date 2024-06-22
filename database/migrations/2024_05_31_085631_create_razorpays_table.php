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
        Schema::create('razorpays', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('razorpay_key')->nullable();
            $table->text('razorpay_secret')->nullable();
             $table->string('country_code');
            $table->string('currency_code');
            $table->double('currency_rate')->default(1);
            $table->string('image')->nullable();
            $table->string('color')->nullable();
          
             $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razorpays');
    }
};
