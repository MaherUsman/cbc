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
        Schema::create('research_article_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_article_id')->constrained('research_articles')->onDelete('cascade');
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
        Schema::dropIfExists('research_article_galleries');
    }
};
