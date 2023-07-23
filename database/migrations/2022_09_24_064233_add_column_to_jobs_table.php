<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('exp_year')->nullable()->after('title');
            $table->string('exp_month')->nullable()->after('exp_year');
            $table->string('addition_education')->nullable()->after('education');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('exp_year');
            $table->dropColumn('exp_month');
            $table->dropColumn('addition_education');
        });
    }
}
