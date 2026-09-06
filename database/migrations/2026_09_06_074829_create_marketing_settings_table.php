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
        Schema::create('marketing_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('gtm_enabled')->default(false);
            $table->string('gtm_container_id')->nullable();
            $table->boolean('ga4_enabled')->default(false);
            $table->string('ga4_measurement_id')->nullable();
            $table->boolean('meta_pixel_enabled')->default(false);
            $table->string('meta_pixel_id')->nullable();
            $table->boolean('tiktok_pixel_enabled')->default(false);
            $table->string('tiktok_pixel_id')->nullable();
            $table->string('google_search_console_verification')->nullable();
            $table->string('bing_webmaster_verification')->nullable();
            $table->string('meta_domain_verification')->nullable();
            $table->longText('custom_head_scripts')->nullable();
            $table->longText('custom_body_start_scripts')->nullable();
            $table->longText('custom_body_end_scripts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_settings');
    }
};
