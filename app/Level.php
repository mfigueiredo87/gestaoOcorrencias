<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;
    //campos a serem adicionados automaticamente
    	protected $fillable = [
    		'nome','project_id'
    	];

    	//um nivel pertece a um projecto
    	public function project(){
    		return $this->belongsTo('App\Project');
    	}
}
