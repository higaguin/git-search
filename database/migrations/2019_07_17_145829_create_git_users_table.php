<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGitUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('git_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('git_detail_id')->unsigned();
            
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
        Schema::dropIfExists('git_users');
    }
}

