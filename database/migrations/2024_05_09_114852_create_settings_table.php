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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->boolean('maintenance_mode')->default(0);
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('enable_save_contact_message')->nullable();
            $table->string('timezone')->nullable();
            $table->string('sidebar_lg_header')->nullable();
            $table->string('sidebar_sm_header')->nullable();
            $table->string('topbar_phone')->nullable();
            $table->string('topbar_email')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('frontend_url')->nullable();
            $table->string('error')->nullable();
            $table->string('current_version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
