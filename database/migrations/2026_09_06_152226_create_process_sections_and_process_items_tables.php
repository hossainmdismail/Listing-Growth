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
        Schema::create('process_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('singleton_key')->default(1)->unique();
            $table->string('label', 100);
            $table->string('title', 255);
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('process_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_section_id')
                ->constrained('process_sections')
                ->cascadeOnDelete();
            $table->string('label_number', 20);
            $table->string('title', 255);
            $table->text('description');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['process_section_id', 'is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_items');
        Schema::dropIfExists('process_sections');
    }
};
