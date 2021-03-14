<?php

use Illuminate\Http\Request;

//criando webservice para associar projectos com o nivel
Route::get('/projecto/{id}/niveis','Admin\LevelController@byProject');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
