<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('uid');            
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('contact_id');
            $table->text('detail')->nullable();
            $table->string('image_src')->nullable();
            $table->enum('status',['1','2'])->default(1);
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
        Schema::dropIfExists('projects');
    }
}
