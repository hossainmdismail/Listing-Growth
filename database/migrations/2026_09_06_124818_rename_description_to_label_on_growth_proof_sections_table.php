<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('growth_proof_sections', function (Blueprint $table) {
            $table->renameColumn('description', 'label');
        });

        DB::table('growth_proof_sections')
            ->whereNull('label')
            ->update(['label' => 'The Fastest Way to Grow']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('growth_proof_sections', function (Blueprint $table) {
            $table->renameColumn('label', 'description');
        });
    }
};
