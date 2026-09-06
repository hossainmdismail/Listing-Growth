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
        Schema::table('faq_items', function (Blueprint $table) {
            $table->boolean('show_on_contact_page')
                ->default(false)
                ->after('is_active');

            $table->index(['faq_section_id', 'show_on_contact_page', 'is_active', 'sort_order'], 'faq_items_page_visibility_order_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faq_items', function (Blueprint $table) {
            $table->dropIndex('faq_items_page_visibility_order_index');
            $table->dropColumn('show_on_contact_page');
        });
    }
};
