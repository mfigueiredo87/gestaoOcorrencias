<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Ocorrencia;
use App\User;
use App\ProjectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //esta opcao faz com que todos os metodos a serem definidos a baixo do constutor, passem pela verificacao do login
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consultar as ocorrencias existentes
        $user = auth()->user();
        $selected_project_id = $user->selected_project_id;

        //verificando o usuario que iniciou sessao
        if ($user->is_support){

        $my_ocorrencies = Ocorrencia::where('project_id', $selected_project_id)->where('support_id', $user->id)->get();
        // $my_ocorrencies = Ocorrencia::where('project_id', $user->selected_project_id)->where('support_id', $user->id)->get();
        // //buscar o nivel e o projecto a que o usuario esta ligado
        $projectUser = ProjectUser::where('project_id', $selected_project_id)->where('user_id', $user->id)->first();
        //ocorrencias pendentes
        // dd($projectuser->level_id);
        $pendentes_ocorrencias = Ocorrencia::where('support_id', null)
        ->where('level_id', $projectUser->level_id)->get();
        }

        //testand a saida
        //dd($pendentes_ocorrencias);
        //minhas ocorrencias
        $minhas_ocorrencias = Ocorrencia::where('client_id', $user->id)->where('project_id', $selected_project_id)->get();

        return view('home')->with(compact('my_ocorrencies','pendentes_ocorrencias','minhas_ocorrencias'));
    } 

    //metodo para selecionar projecto de acordo ao user logado
    public function selectProject($id){
        //referenciar o usuario autenticado
        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }

   
}
