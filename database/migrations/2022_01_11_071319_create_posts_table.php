<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('post_title');
            $table->text('short_content')->nullable();
            $table->longtext('full_content')->nullable();
            $table->string('post_slug');
            $table->integer('author_id')->unsigned();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->enum('post_status',['1','2'])->default(1);
            $table->string('post_type');
            $table->string('src_url')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
