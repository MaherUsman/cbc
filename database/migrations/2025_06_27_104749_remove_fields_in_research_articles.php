<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('research_articles', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('banner_image');
            $table->string('article_pdf_file')->nullable()->after('title');
        });

        Schema::dropIfExists('research_article_galleries');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('research_articles', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->string('banner_image')->nullable()->after('description');
            $table->dropColumn('article_pdf_file');
        });

        Schema::create('research_article_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_article_id')->constrained('research_articles')->onDelete('cascade');
            $table->string('title', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('display_order')->default(1);
            $table->timestamps();
        });
    }
};
