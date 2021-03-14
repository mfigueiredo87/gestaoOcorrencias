<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Project;

class User extends Authenticatable
{
   // use Notifiable;

    use SoftDeletes;//eliminacao logica

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //relacionamento com outros modelos
    public function projects(){
        //relacao muitos para muitos

        return $this->belongsToMany('App\Project');
    }

    //accessores
    public function getListOfProjectsAttribute(){
        //se o usuario logado pertence a equipa de suporte, listar os projectos associados a ele, caso nao, listar todos os projectos

        if($this->role == 1)
            return $this->projects;

        return Project::all();
    }

    //para validacao
    public function getIsAdminAttribute()
    {
        return $this->role ==0;
    } 
    public function getIsClienteAttribute()
    {
        return $this->role ==2;
    }
    //accessor de controlo de user logado
      public function getIsSupportAttribute()
    {
        return $this->role ==1;
    } 

    public function canTake( Ocorrencia $ocorrencia){
        //relacionando o usuario logado com a ocorrencia registada
        return ProjectUser::where('user_id', $this->id)
        ->where('level_id', $ocorrencia->level_id)->first();


    }
    //alternando a imagem de acordo ao usuario logado
    public function getAvatarPathAttribute(){
      if ($this->is_cliente)
        return '/images/cliente.png';
      //else

      return '/images/support.png';
    }
}
