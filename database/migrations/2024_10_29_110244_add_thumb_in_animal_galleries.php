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
        Schema::table('animal_galleries', function (Blueprint $table) {
            $table->string('thumb')->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('animal_galleries', function (Blueprint $table) {
           $table->dropColumn('thumb');
        });
    }
};
