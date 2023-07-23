<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('job_experience')->nullable();
            $table->text('job_description')->nullable();
            $table->text('role_responsibilty')->nullable();
            $table->string('candidate_profile')->nullable();
            $table->string('education')->nullable();
            $table->string('role')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('functional_area')->nullable();
            $table->string('employement_type')->nullable();
            $table->string('role_category')->nullable();
            $table->string('key_skills')->nullable();
            $table->longText('about_company')->nullable();
            $table->longText('company_info')->nullable();
            $table->string('address')->nullable();
            $table->boolean('top_rated')->default(0)->nullable();
            $table->string('salary')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->string('image_src')->nullable();
            $table->enum('status',['1','2'])->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
