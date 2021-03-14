<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectUser;

class ProjectUserController extends Controller
{
    public function store(Request $request){

    	//validando o nivel que pertence ao projecto e que exista bem como seu nivel e o usuario.
    	//verificando se os projectos ja existem

        $project_id =$request->input('project_id');
        $user_id = $request->input('user_id');

        $project_user = ProjectUser::where('project_id', $project_id)
                ->where('user_id', $user_id)->first();//pega a penas a primeira consulta encontrada

                if($project_user)
                    return back()->with('notification','O usuário seleccionado ja pertence a este projecto. Edite ou Apague a releção');

    	$project_user = new ProjectUser();
    	$project_user->project_id = $project_id;
    	$project_user->user_id = $user_id;
    	$project_user->level_id = $request->input('level_id');
    	$project_user->save();

    	return back()->with('notification', 'Projecto associado com sucesso');
    }

    public function delete($id){

        ProjectUser::find($id)->delete();

        return back()->with('notification', 'Projecto eliminado com sucesso');

    }
}
