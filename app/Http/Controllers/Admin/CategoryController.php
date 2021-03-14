<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    //
    public function store(Request $request){
    	$this->validate($request, [
    		'nome'=>'required'
    		], [
    			'nome.required' => 'É necessário inserir um nome para a categoria.'
    		]);

    	Category::create($request->all());// salvar em massa
    	return back()->with('notification', 'Categoria registada com sucesso');
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
    		'nome'=>'required'
    		], [
    			'nome.required' => 'É necessário inserir um nome para a categoria.'
    		]);
    	$category_id = $request->input('category_id');

    	$category = Category::find($category_id);//pesquisa a categoria pelo id seleccionado e depois associa o nome e salva
    	$category->nome=$request->input('nome');
    	$category->save();

    	return back()->with('notification', 'Categoria alterada com sucesso');
    }
    public function delete($id){
        Category::find($id)->delete();
        return back()->with('notification', 'Categoria eliminada com sucesso');
    }
}
