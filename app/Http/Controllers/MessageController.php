<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
  public function __construct()
    {
        //esta opcao faz com que todos os metodos a serem definidos a baixo do constutor, passem pela verificacao do login
        $this->middleware('auth');
    }
    public function store(Request $request){
    	
    	$rules =[
    	'message' => 'required|min:5|max:255'
    	];

    	$messages = [
    	'message.required'=>'Campo de preenchimento obrigatorio',
    	'message.min'=>'Este campo deve conter no minimo 5 caracteres',
    	'message.max'=>'Passou do limite de caracteres aceites, apenas 255'
    	];

    	$this->validate($request, $rules, $messages);

    	$message = new Message();
    	$message->ocorrencia_id = $request->input('ocorrencia_id');
    	$message->message = $request->input('message');
    	$message->user_id = auth()->user()->id;
    	$message->save();

    	return back()->with('notification', 'Mensagem enviada com sucesso');

    }
}
