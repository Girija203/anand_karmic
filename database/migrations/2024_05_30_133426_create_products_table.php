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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');    
            $table->string('video')->nullable(); 
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->text('short_description');
            $table->longText('long_description');
            $table->boolean('is_top', [0, 1])->default(0);
            $table->boolean('new_product', [0, 1])->default(0);
            $table->boolean('is_best', [0, 1])->default(0);
            $table->boolean('is_featured', [0, 1])->default(0);
            $table->boolean('is_specification', [0, 1])->default(1);
            $table->boolean('is_sold', [0, 1])->default(0);
            $table->boolean('is_shareable', [0, 1])->default(1);
            $table->boolean('status', [0, 1])->default(1);         
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
