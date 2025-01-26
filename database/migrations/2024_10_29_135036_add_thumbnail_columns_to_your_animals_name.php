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
        Schema::table('animals', function (Blueprint $table) {
//            $table->string('image_thumbnail')->nullable();
//            $table->string('banner_image_thumbnail')->nullable();
//            $table->string('home_image_thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
//            $table->dropColumn('image_thumbnail');
//            $table->dropColumn('banner_image_thumbnail');
//            $table->dropColumn('home_image_thumbnail');

        });
    }
};
