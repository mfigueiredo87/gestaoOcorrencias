<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            //atrbutos do relacionamento
            //relacionamento com o projecto

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
             //relacionamento com o utilizador
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //relacao com o nivel
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');

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
        Schema::dropIfExists('project_user');
    }
}
