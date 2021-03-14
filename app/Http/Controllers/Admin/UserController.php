<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Project;
use App\ProjectUser;

class UserController extends Controller
{
    //
    public function index()

    {   
    	$users = User::where('role', 1)->get();
    	return view('admin.users.index')->with(compact('users'));
    }

    public function store(Request $request)
    {

    	$rules=[
    		'name' =>'required|max:255',
    		'email' =>'required|email|max:255|unique:users',
    		'password' =>'required|min:6'
    	];
    	$messages=[
    		'name.required'=>' Preencha o campo nome de utilizador.',
    		'name.max'=>' O nome é demasiado curto.',
    		'email.required'=>'O preenchimento de e-mail é obritório.',
    		'email.email'=>'O e-mail inserido não é válido.',
    		'email.max'=>'O e-mail inserido é demasido extenso.',
    		'email.unique'=>'O e-mail inserido ja se encontra registado.',
    		'password.required'=>'É obritório inserir ma senha.',
    		'password.min'=>'A senha deve conter pelo menos 6 caracteres.'
    	];

    	$this->validate($request, $rules, $messages);

    	$user = new user();
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = bcrypt($request->input('password'));
    	$user->role = 1;

    	$user->save();

    	//dd($request->all());
    	return back()->with('notification','Usuario de suporte inserido com sucesso.');
    } 

    public function edit($id)
    {
    	$user = User::find($id);
        $projects = Project::all();
        $projects_user = ProjectUser::where('user_id', $user->id)->get();//relacao entre o usuario e o projecto
    	return view('admin.users.edit')->with(compact('user','projects','projects_user'));
    } 

    public function update($id, Request $request)
    {
    	$user = User::find($id);
    	$rules=[
    		'name'=>'required|max:255'
    		// 'password' => 'min:6'
    	];
    	$messages=[
    		'name.required'=>' Preencha o campo nome de utilizador.',
    		'name.max'=>' O nome é demasiado curto.',
    		'password.min'=>'A senha deve conter pelo menos 6 caracteres.'
    	];
    	$this->validate($request, $rules, $messages);
    	$user = User::find($id);
    	$user->name = $request->input('name');

    	$password = $request->input('password');
    	//alterar a senha somente se for inserida
    	if($password)
    		$user->password=bcrypt($password);
    	
    	$user->save();

    	return back()->with('notification', 'Dados do usuario alterados com sucesso.');
    }

    public function delete($id){

    	$user = User::find($id);
    	$user->delete();
    	
    	return back()->with('notification', 'Dado eliminado com sucesso.');

    }
}
