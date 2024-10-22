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
        Schema::table('career_applications', function (Blueprint $table) {
            $table->foreignId('job_id')->nullable()->after('id')->constrained('career_jobs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('career_applications', function (Blueprint $table) {
           $table->dropForeign(['job_id']);
           $table->dropColumn('job_id');
        });
    }
};
