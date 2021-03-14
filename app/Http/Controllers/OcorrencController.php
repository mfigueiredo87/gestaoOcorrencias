<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Ocorrencia;
use App\Project;
use App\Level;
use App\ProjectUser;

class OcorrencController extends Controller
{
	   public function __construct()
    {
        //esta opcao faz com que todos os metodos a serem definidos a baixo do constutor, passem pela verificacao do login
        $this->middleware('auth');
    }

    //visualizar ocorrencia pelo id
    public function show($id){
        $ocorrencia = Ocorrencia::findOrFail($id);
        //passando as mensagens das ocorrencias
        $messages = $ocorrencia->messages;

        return view('ocorrencias.show')->with(compact('ocorrencia','messages'));
    }

     public function create()
    {
        //$project = Project::find(1);
        //$categories = $project->categories;

        $categories = Category::where('project_id', 1)->get();
        return view('ocorrencias.create')->with( compact('categories'));
    }
    //metodo para salvar
    public function store(Request $request)
    {
      
        $this->validate($request, Ocorrencia::$rules, Ocorrencia::$messages);

        $ocorrencia = new Ocorrencia();
        $ocorrencia->category_id= $request->input('category_id') ?: null;
        $ocorrencia->prioridade=$request->input('prioridade');
        $ocorrencia->title=$request->input('title');
        $ocorrencia->descricao=$request->input('descricao');
        //verificando o user

        $user = auth()->user();

        $ocorrencia->client_id= $user->id; 
        //$ocorrencia = User::where('support_id', $user->role(1))->get();
        //$ocorrencia->support_id= $user->id; 
        $ocorrencia->project_id= $user->selected_project_id; 
         //acedendo o projecto pelo nivel
        // $minhas_ocorrencias = Ocorrencia::where('client_id', $user->id)->where('project_id', $selected_project_id)->get();
        
        $ocorrencia->level_id = Project::find($user->selected_project_id)->first_level_id;

        //dd($ocorrencia->level_id);

        $ocorrencia->save();

        return back();
    }

    public function take($id){
        //garantindo a seguranca do acesso

        $user = auth()->user();
        //se o usuario nao for da equipa de suporte devolver a pagina previa
            if (! $user->is_support)
                return back();
         //se for de suporte mas nao estiver associado ao projecto ou nao tem nivel da ocorrencia
        $ocorrencia = Ocorrencia::findOrFail($id);
             //relacionando o projecto com a ocorrencia
         $project_user = ProjectUser::where('project_id', $ocorrencia->project_id)->where('user_id', $user->id)->first();   
        //se nao existe conscidencia do codigo anterior, 
         if(! $project_user)
            return back();
        //relacionando o projecto com o nivel, os niveis tem q ser iguais caso contrario nao permitir o acesso
        if ($project_user->level_id != $ocorrencia->level_id)
            return back();
        //se estiver tudo bem, entao prosseguir
        $ocorrencia->support_id = $user->id;
        $ocorrencia->save();

        return back();
        
    }

    public function solve($id){
        
          $ocorrencia = Ocorrencia::findOrFail($id);//validando se o id do usuario logado eh o mesmo com o usuario que a criou a ocorrencia, se nao nao faz nada
        if($ocorrencia->client_id != auth()->user()->id)
            return back();

        $ocorrencia->active = 0;//false
        $ocorrencia->save();

        return back();

    }
    public function open($id){
        $ocorrencia = Ocorrencia::findOrFail($id);//validando se o id do usuario logado eh o mesmo com o usuario que a criou a ocorrencia, se nao nao faz nada
        if($ocorrencia->client_id != auth()->user()->id)
        return back();

        $ocorrencia->active = 1;//true
        $ocorrencia->save();

        return back();
    }
    public function editar($id){
        
    }
    public function edit($id){
        $ocorrencia = Ocorrencia::findOrFail($id);
        $categories = $ocorrencia->project->categories;
        return view('ocorrencias.edit')->with(compact('ocorrencia', 'categories'));
    }
    public function update(Request $request, $id){
        $this->validate($request, Ocorrencia::$rules, Ocorrencia::$messages);

        $ocorrencia = Ocorrencia::findOrFail($id);

        $ocorrencia->category_id= $request->input('category_id') ?: null;
        $ocorrencia->prioridade=$request->input('prioridade');
        $ocorrencia->title=$request->input('title');
        $ocorrencia->descricao=$request->input('descricao');
        //verificando o user

        // $user = auth()->user();

        // $ocorrencia->client_id= $user->id; 
        // //$ocorrencia = User::where('support_id', $user->role(1))->get();
        // //$ocorrencia->support_id= $user->id; 
        // $ocorrencia->project_id= $user->selected_project_id; 
        //  //acedendo o projecto pelo nivel
        // // $minhas_ocorrencias = Ocorrencia::where('client_id', $user->id)->where('project_id', $selected_project_id)->get();
        
        // $ocorrencia->level_id = Project::find($user->selected_project_id)->first_level_id;

        // //dd($ocorrencia->level_id);

        $ocorrencia->save();

        return redirect("/ver/$id");
    }
    public function nextLevel($id){
        $ocorrencia = Ocorrencia::findOrFail($id);
        $level_id = $ocorrencia->level_id; //verificando o nivel em que se encontra a ocorrencia

        //aceder todos os niveis dos projectos

        $project  = $ocorrencia->project;
        $levels = $project->levels;

       $next_level_id = $this->getNextLevelId($level_id, $levels);

       if ($next_level_id){
          $ocorrencia->level_id = $next_level_id;
          //se alterar o nivel, passa o suport id para null
          $ocorrencia->support_id = null;
            $ocorrencia->save();
            return back();
       }

       return back()->with('notification', 'Não é possivel passar para o nivel seguinte');
    }

     public function getNextLevelId($level_id, $levels){
        //verificando o tamanho da coleccao
        if(sizeof($levels)<=1)
            return null;// a ideia eh que n adianta passar trazer colecao de nivel inferior a 1
        //fazendo a busca dos niveis

        $position = -1;
        //buscar todos os niveis ate ao ultimo
        for ($i=0; $i <sizeof($levels) ; $i++) { 
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }
        if($position == 1)
            return null;
        // //quando a posicao do nivel for igual ao tamanho da colecao no caso ate ao ultimo
        if($position == sizeof($levels)-1)
            return null;

        //dd($levels[$i+1]);

        //dd(sizeof($levels));
        return $levels[$position+1]->id;
       }
}
