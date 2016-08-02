<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LP_portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->string('description')->nullable();
            $table->text('body')->nullable();
            $table->string('website')->nullable();
            $table->date('launched_date');
            $table->enum('status', ['draft', 'published', 'trashed']);
            $table->integer('sequence');
            $table->string('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('LP_pages');
    }
}
