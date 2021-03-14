<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('descricao');
            $table->string('prioridade', 1);//este num 1 indica que a descricao vai receber apenas 1 caracter
            //passando as chaves estrangeiras
            $table->boolean('active')->default(1);

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            //relacao com o projecto
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            //relacao com a tabela nivel

            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');
            //relacao com o usuario que fez o registo da ocorrencia\
            //usuario cliente
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            //usuario de suport
            $table->integer('support_id')->unsigned()->nullable();
            $table->foreign('support_id')->references('id')->on('users');

             //$table->softDeletes();
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
        Schema::dropIfExists('ocorrencias');
    }
}
