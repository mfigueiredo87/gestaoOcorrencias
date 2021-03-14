<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Level;

class Project extends Model
{
    use SoftDeletes;
    //regras de validacao
    

    	public static $rules = [
    		'nome' => 'required',
    		'descricao' => '',
    		'start' => 'date'
    	];

    	public static $messages = [
    		'nome.required' => 'É necessário inserir um nome para o projecto',
    		'start.date' => 'A data não tem um formato adequado.'
    	];

    	//campos a serem adicionados automaticamente
    	protected $fillable = [
    		'nome','descricao','start',
    	];

        //relacionamento com outros modelos
    public function users(){
        //relacao muitos para muitos

        return $this->belongsToMany('App\User');
    }

    //accessores


        //metodo para fazer a relacao com a categoria, sabendo que um projecto tem varias categorias
        public function categories(){
            
            return $this->hasMany('App\Category');//passamos a relacao de um para muitos e no caso a categoria usamos mesmo o modelo Category. Um projecto de muitas categorias

        }

        public function levels(){
            
            return $this->hasMany('App\Level');//um projecto tem muitos niveis

        }

        //acessor de project
                         
        public function getFirstLevelIdAttribute()
        {
        
        //return Project::where('level_id', $user->id)->first()->id;
          return $this->levels->first()->id;
        }
}
