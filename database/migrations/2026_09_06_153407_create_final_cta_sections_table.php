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
        Schema::create('final_cta_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('singleton_key')->default(1)->unique();
            $table->string('label', 100);
            $table->string('title', 500);
            $table->text('description');
            $table->string('primary_button_text', 100);
            $table->string('primary_button_url', 2048);
            $table->string('secondary_button_text', 100);
            $table->string('secondary_button_url', 2048);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_cta_sections');
    }
};
