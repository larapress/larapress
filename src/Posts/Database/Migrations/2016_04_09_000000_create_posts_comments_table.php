<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LP_posts_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_given');
            $table->string('email_given');
            $table->string('ip_address');
            $table->string('body');
            $table->integer('post_id');
            $table->integer('user_id')->nullable();
            $table->enum('status', ['submitted', 'published', 'flagged', 'suspended', 'trashed']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('LP_posts_comments');
    }
}
