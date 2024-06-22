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
        Schema::create('meta_keys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meta_types_id');
            $table->string('name');
            $table->foreign('meta_types_id')->references('id')->on('meta_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_keys');
    }
};
