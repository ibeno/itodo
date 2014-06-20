<?php



Route::group(array('before' => 'auth'), function(){
	
	Route::any('/', array('as' => 'home', function(){
		 
		 return View::make('hello');

	}));

	/* List Task Routes */
	Route::any('task', 'TaskController@getListar');
	Route::any('tasks', 'TaskController@getListar');

	/* Add Task Routes */
	Route::get('task/add/{lista_id}','TaskController@getAdd');
	Route::post('tasks/add/{lista_id}', 'TaskController@postAdd');

	/* Checking Tasks */
	Route::post('task/check', 'TaskController@check');

	Route::get('list/create', 'ListController@getCreate');
	Route::post('list/create', 'ListController@postCreate');

	Route::get('list', 'ListController@listar');
	Route::get('list/{lista_id?}', 'ListController@listarTasks');

	Route::get('cadastro', 'UserController@form');
	Route::get('cadastro', ['before' => 'csrf', 'uses' =>'UserController@cadastro']);

});

/* Login */
Route::get('login', function(){
	return View::make('login');
});

Route::post('login', array('before' => 'csrf', function(){

	$regras = array(
		"email" => "required|email",
		"senha" => "required"
	);

	$validacao = Validator::make(Input::all(), $regras);
	if ($validacao->fails()) {

		return Redirect::to('login')->withErrors($validacao);
	}

	//tenta logar com o usuário
	if (Auth::attempt(array('email' =>Input::get('email'), 'password' => Input::get('senha')))) {
		return Redirect::to('/');
	}
	else{
		return Redirect::to('login')->withErrors('Usuário ou Senha Inválido');
	}

}));