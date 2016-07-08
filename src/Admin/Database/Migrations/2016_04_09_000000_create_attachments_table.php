<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LP_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('type')->default('image');
            $table->string('url')->nullable();
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();
            $table->string('context');
            $table->integer('priority');
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('LP_attachments');
    }
}
