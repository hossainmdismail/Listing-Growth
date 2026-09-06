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
        Schema::create('growth_proof_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('growth_proof_section_id')
                ->constrained('growth_proof_sections')
                ->cascadeOnDelete();
            $table->string('label', 150);
            $table->string('value', 50);
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('growth_proof_statistics');
    }
};
