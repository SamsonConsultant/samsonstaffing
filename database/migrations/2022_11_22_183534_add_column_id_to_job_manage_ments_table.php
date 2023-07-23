<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdToJobManageMentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_manage_ments', function (Blueprint $table) {
            $table->string('title')->nullable()->after('cv_path');
            $table->string('email')->nullable()->after('title');
            $table->string('cc_email')->nullable()->after('email');
            $table->string('st_date')->nullable()->after('cc_email');
            $table->string('st_time')->nullable()->after('st_date');
            $table->string('ed_date')->nullable()->after('st_time');
            $table->string('ed_time')->nullable()->after('ed_date');
            $table->string('interview_status')->default(0)->after('ed_time');
            $table->string('selection_status')->default(0)->after('interview_status');
            $table->string('invoice_status')->default(0)->after('selection_status');
            $table->string('id_card')->nullable()->after('invoice_status');
            $table->string('offer_letter')->nullable()->after('id_card');
            $table->string('office_location')->nullable()->after('offer_letter');
            $table->string('person_name')->nullable()->after('office_location');
            $table->string('person_contact')->nullable()->after('person_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_manage_ments', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('email');
            $table->dropColumn('cc_email');
            $table->dropColumn('st_date');
            $table->dropColumn('st_time');
            $table->dropColumn('ed_date');
            $table->dropColumn('ed_time');
            $table->dropColumn('interview_status');
            $table->dropColumn('selection_status');
            $table->dropColumn('invoice_status');
            $table->dropColumn('id_card');
            $table->dropColumn('offer_letter');
            $table->dropColumn('office_location');
            $table->dropColumn('person_name');
            $table->dropColumn('person_contact');
        });
    }
}
