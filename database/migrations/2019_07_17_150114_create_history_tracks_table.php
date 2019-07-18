<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('git_user_id')->unsigned();
            $table->integer('git_detail_id')->unsigned();

            $table->foreign('git_user_id')
            ->references('id')
            ->on('git_users')
            ->onDelete('cascade');

            $table->foreign('git_detail_id')
            ->references('id')
            ->on('git_details')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('history_tracks');
    }
}
