<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

class LevelController extends Controller
{

    public function byProject($id){
        //devolvendo os niveis de acordo ao projecto associado
        return Level::where('project_id', $id)->get();

    }

     public function store(Request $request){

    	$this->validate($request, [
    		'nome'=>'required'
    		], [
    			'nome.required' => 'É necessário inserir um nome para o nível.'
    		]);

    	Level::create($request->all());// salvar em massa
    	return back()->with('notification', 'Nível registado com sucesso');
    }

       public function update(Request $request)
    {
    	$this->validate($request, [
    		'nome'=>'required'
    		], [
    			'nome.required' => 'É necessário inserir um nome para o nivel.'
    		]);
    	$level_id = $request->input('level_id');

    	$level = Level::find($level_id);//pesquisa a categoria pelo id seleccionado e depois associa o nome e salva
    	$level->nome=$request->input('nome');
    	$level->save();

    	return back()->with('notification', 'Nivel alterado com sucesso');
    }
      public function delete($id){
        Level::find($id)->delete();
        return back()->with('notification', 'Nivel eliminado com sucesso');
    }
}
