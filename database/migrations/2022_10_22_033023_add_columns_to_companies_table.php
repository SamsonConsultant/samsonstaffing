<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('country_id')->nullable()->after('customer_since');
            $table->string('state_id')->nullable()->after('country_id');
            $table->string('city')->nullable()->after('state_id');
            $table->string('zip_code')->nullable()->after('city');
            $table->string('phone_code')->nullable()->after('zip_code');
            $table->string('phone')->nullable()->after('phone_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city');
            $table->dropColumn('zip_code');
            $table->dropColumn('phone_code');
            $table->dropColumn('phone');
        });
    }
}
