<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('role_id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('gender')->nullable()->after('last_name');
            $table->string('home_phone')->nullable()->after('contact_number');
            $table->integer('country_id')->nullable()->after('home_phone');
            $table->integer('state_id')->nullable()->after('country_id');
            $table->string('city')->nullable()->after('state_id');
            $table->string('zip_code')->nullable()->after('city');
            $table->text('address')->nullable()->after('zip_code');
            $table->string('user_lang')->nullable()->after('address');
            $table->string('lang_speak')->nullable()->after('user_lang');
            $table->string('lang_written')->nullable()->after('lang_speak');
            $table->string('current_cv')->nullable()->after('lang_written');
            $table->string('current_ctc')->nullable()->after('current_cv');
            $table->string('notice_period')->nullable()->after('current_ctc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('home_phone');
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city');
            $table->dropColumn('zip_code');
            $table->dropColumn('address');
            $table->dropColumn('user_lang');
            $table->dropColumn('lang_speak');
            $table->dropColumn('lang_written');
            $table->dropColumn('current_cv');
            $table->dropColumn('current_ctc');
            $table->dropColumn('notice_period');
        });
    }
}
