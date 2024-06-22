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
        Schema::create('product_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
         
            $table->unsignedBigInteger('meta_keys_id');
            $table->string('content');
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
           
             $table->foreign('meta_keys_id')->references('id')->on('meta_keys')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_metas');
    }
};
