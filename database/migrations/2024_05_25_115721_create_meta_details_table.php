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
        Schema::create('meta_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_posts_id');
            $table->unsignedBigInteger('meta_keys_id')->nullable();
            $table->string('content')->nullable();
            $table->timestamps();
             $table->foreign('blog_posts_id')->references('id')->on('blog_posts')->onDelete('cascade');
             $table->foreign('meta_keys_id')->references('id')->on('meta_keys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_details');
    }
};
