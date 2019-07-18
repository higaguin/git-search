<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('git_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('bio')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->boolean('isHireable')->nullable();
            $table->boolean('isEmployee')->nullable();
            $table->string('createdAt')->nullable();
            $table->string('avatarUrl')->nullable();
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
        Schema::dropIfExists('git_details');
    }
}