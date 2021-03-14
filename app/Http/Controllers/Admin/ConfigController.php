<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    //  public function index(){
    // 	return 'Rota / COnfig resulta por UserController@index';
    // }

    public function index(){

    	return view('admin.config.index');
    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){
    	
    }
}
