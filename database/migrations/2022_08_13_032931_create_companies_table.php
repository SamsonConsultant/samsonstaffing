<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('uid');
            $table->string('account_number')->nullable();
            $table->string('account_type')->nullable();
            $table->string('customer_since')->nullable();
            $table->string('address')->nullable();
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
