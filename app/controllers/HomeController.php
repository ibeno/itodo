<?php

class HomeController extends BaseController {


	public function ola($usuario = 'Iberno')
	{
		$usuario = ucwords($usuario);
		return View::make('hello')->with('usuario', $usuario);
	}

}
