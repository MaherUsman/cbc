<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('activity_galleries', function (Blueprint $table) {
            $table->string('thumb')->nullable()->after('image');
            $table->string('compressed')->nullable()->after('thumb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('activity_galleries', function (Blueprint $table) {
           $table->dropColumn('thumb');
            $table->dropColumn('compressed');
        });
    }
};
