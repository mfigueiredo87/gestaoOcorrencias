<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    //relacionamento com o usuario da mensagem. Uma mensagem pertence a um usuario e um usuario tem muitas mensagens
    public function user(){
    	return $this->belongsTo('App\User');
    }

}
