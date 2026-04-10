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
        if (!Schema::hasColumn('activities', 'banner_image')) {
            Schema::table('activities', function (Blueprint $table) {
                $table->string('banner_image')->nullable();
            });
        }
        if (!Schema::hasColumn('tobas', 'banner_image')) {
            Schema::table('tobas', function (Blueprint $table) {
                $table->string('banner_image')->nullable();
            });
        }
        if (!Schema::hasColumn('securities', 'banner_image')) {
            Schema::table('securities', function (Blueprint $table) {
                $table->string('banner_image')->nullable();
            });
        }
        if (!Schema::hasColumn('animal_categories', 'banner_image')) {
            Schema::table('animal_categories', function (Blueprint $table) {
                $table->string('banner_image')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('activities', 'banner_image')) {
            Schema::table('activities', function (Blueprint $table) {
                $table->dropColumn('banner_image');
            });
        }
        if (Schema::hasColumn('tobas', 'banner_image')) {
            Schema::table('tobas', function (Blueprint $table) {
                $table->dropColumn('banner_image');
            });
        }
        if (Schema::hasColumn('securities', 'banner_image')) {
            Schema::table('securities', function (Blueprint $table) {
                $table->dropColumn('banner_image');
            });
        }
        if (Schema::hasColumn('animal_categories', 'banner_image')) {
            Schema::table('animal_categories', function (Blueprint $table) {
                $table->dropColumn('banner_image');
            });
        }
    }
};
