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
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 254);
            $table->text('listing_url')->nullable();
            $table->string('category', 100)->nullable();
            $table->string('service', 150)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 30)->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index('email');
            $table->index(['status', 'created_at']);
            $table->index('category');
            $table->index('service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
