<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/seleccionar/projecto/{id}', 'HomeController@selectProject');

//reportar ocorrencia
Route::get('/reportar', 'OcorrencController@create');

Route::post('/reportar', 'OcorrencController@store');

//editar ocorrencia que ja existe
Route::get('/ocorrencia/{id}/editar', 'OcorrencController@edit');
Route::post('/ocorrencia/{id}/editar', 'OcorrencController@update');

//ver ocorrencia pelo id
Route::get('/ver/{id}', 'OcorrencController@show');
//ocorrencias, accoes

Route::get('/ocorrencia/{id}/atender', 'OcorrencController@take');
Route::get('/ocorrencia/{id}/resolver', 'OcorrencController@solve');
Route::get('/ocorrencia/{id}/abrir', 'OcorrencController@open');

Route::get('/ocorrencia/{id}/passar', 'OcorrencController@nextLevel');

//rotas para as mensagens
Route::post('/mensagens','MessageController@store');

//para o menu de administracao atraves de um middleware
Route::group(['middleware' => 'admin','namespace'=>'Admin'], function(){
	//rotas para utilizador
	Route::get('/usuarios', 'UserController@index');
	Route::post('/usuarios', 'UserController@store');//para salvar

	Route::get('/usuario/{id}', 'UserController@edit');//para editar pelo id
	Route::post('/usuario/{id}', 'UserController@update');//actualizar pelo id
	Route::get('/usuario/{id}/eliminar', 'UserController@delete');//actualizar pelo id
//fim das rotas para utilizador
	
	//rotas para projectos
// Route::get('/projectos', 'ProjectController@index');
Route::get('/projectos', 'ProjectController@index');
Route::post('/projectos', 'ProjectController@store');
Route::get('/projecto/{id}', 'ProjectController@edit');//para editar pelo id
	Route::post('/projecto/{id}', 'ProjectController@update');//actualizar pelo id
Route::get('/projecto/{id}/eliminar', 'ProjectController@delete');//eliminar pelo id
Route::get('/projecto/{id}/restaurar', 'ProjectController@restore');//restaurar pelo id

//Rotas de categoria
Route::post('/categorias','CategoryController@store');
Route::post('/categoria/editar','CategoryController@update');
Route::get('/categoria/{id}/eliminar','CategoryController@delete');

// Rotas para Niveis
Route::post('/niveis','LevelController@store');
Route::post('/nivel/editar','LevelController@update');
Route::get('/nivel/{id}/eliminar','LevelController@delete');

//projecUser, relacionamento dentre o projecto e usuario

Route::post('/projecto-usuario','ProjectUserController@store');

Route::get('/projecto-usuario/{id}/eliminar','ProjectUserController@delete');


	Route::get('/config', 'ConfigController@index');
});



 