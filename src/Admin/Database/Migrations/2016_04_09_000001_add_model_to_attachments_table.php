<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModelToAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('LP_attachments', function (Blueprint $table) {
            $table->string('model');
            $table->integer('model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('LP_attachments', function (Blueprint $table) {
            $table->dropColumn('model');
            $table->dropColumn('model_id');
        });
    }
}
