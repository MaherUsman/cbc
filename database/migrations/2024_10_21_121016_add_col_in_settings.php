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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('Loading_page_text')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
           $table->dropColumn('Loading_page_text');
        });
    }
};
