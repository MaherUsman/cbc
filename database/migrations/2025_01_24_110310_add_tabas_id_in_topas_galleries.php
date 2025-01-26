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
        Schema::table('topas_galleries', function (Blueprint $table) {
            $table->foreignId('tobas_id')->nullable()->after('id')->constrained('tobas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('topas_galleries', function (Blueprint $table) {
            $table->dropColumn('tobas_id');
        });
    }
};
