<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Project;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //verificando os suarios autenticados
    protected function authenticated(){

        $user = auth()->user();

        //se o usario logado for client ou admin mostrar o primeiro projecto
        if(! $user->selected_project_id){

        if ($user->is_admin || $user->is_client){
            $user->selected_project_id = Project::first()->id;
             
        }else{

        //se nao, usuario de suporte
             $user->selected_project_id = $user->project->first()->id;
           
        }
    //aplicar metodi save sempre que n se registar um projecto
         $user->save();
        
        }
    }
}
