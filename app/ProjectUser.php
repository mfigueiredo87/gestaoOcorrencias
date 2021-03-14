<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //relacionando os projectos, niveis e utilizadores (pivo)
    protected $table = 'project_user';

    //criando os relacionamentos. Sabendo que um utilizador tem varios projectosUser e um projecto pertence a varios projectosUser

    public function project(){
    	return $this->belongsTo('App\Project');
    } 

    public function level(){
    	return $this->belongsTo('App\Level');
    }
}
