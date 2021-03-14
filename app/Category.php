<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
   	use SoftDeletes;
    	//campos a serem adicionados automaticamente
    	protected $fillable = [
    		'nome','project_id'
    	];

    	//aceder o projecto a que a categoria pertence
    	public function project(){

    		return $this->belongsTo('App\Project');//estamos adizer que uma categoria pertence a um projecto
    	}

}
