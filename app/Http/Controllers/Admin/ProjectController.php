<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{
    
     public function index(){

     	$projects = Project::withTrashed()->get();//este withTrashed mostra todos os dados inclusive os dados como eliminados
    	return view('admin.projectos.index')->with(compact('projects'));
    }

    public function store(Request $request)
    {
    	
    	
    	$this->validate($request, Project::$rules, Project::$messages);
    	//criad novo projecto
    	Project::create($request->all());//para fazer save all em que os campos ja foram definidos no model

    	return back()->with('notification', 'Projecto registado com sucesso');

    }

    public function edit($id){

    	$project = Project::find($id);
        //passando valores da categoria e do nivel
        $categories = $project->categories;//relacao com os modelos definidos (projectos e categorias)
        $levels = $project->levels;//Level::where('project_id', $id)->get();
    	return view('admin.projectos.edit')->with(compact('project','categories','levels'));
    }

    public function update($id, Request $request){

    		$this->validate($request, Project::$rules, Project::$messages);

    		Project::find($id)->update($request->all());

    		return back()->with('notification', 'Projecto adicionado com sucesso');
    }

    public function delete($id){

    	$project = Project::find($id);
    	$project->delete();
    	
    	return back()->with('notification', 'Projecto eliminado com sucesso.');

    }public function restore($id){
    	//Project::find($id)->restore(); restaura um dado eliminado na base de dados
    	Project::withTrashed()->find($id)->restore();//para restaurar o projecto dado como eliminado 
    	     	
    	return back()->with('notification', 'Projecto restaurado com sucesso.');

    }

}
