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
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
//            $table->text('description');
            $table->string('banner_image');
            $table->timestamps();
        });

        Schema::create('security_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('security_id')->constrained('securities')->onDelete('cascade');
            $table->string('title', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('display_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_galleries');
        Schema::dropIfExists('securities');

    }
};
