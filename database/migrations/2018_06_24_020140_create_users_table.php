
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->smallInteger('role')->default(2);//role ou regra 0: administrador| 1: Usuario de suporte | 2: para clientes. Por defeito, os usuarios a serem registados serao clientes

            $table->integer('selected_project_id')->unsigned()->nullable();
            $table->foreign('selected_project_id')->references('id')->on('projects');

            $table->rememberToken();
            $table->softDeletes();//deletar logicamente
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
        Schema::dropIfExists('users');
    }
}
