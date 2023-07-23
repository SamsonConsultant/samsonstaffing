<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobManageMentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_manage_ments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->string('status')->default(1);
            $table->string('state_id')->nullable();
            $table->enum('cv_status',['0','1'])->default(0);
            $table->string('cv_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_manage_ments');
    }
}
