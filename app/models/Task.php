<?php

class Task extends Eloquent{

	public function listar(){

		return $this->belongsTo('listas', 'list_id')
	}

	public function getUsuarioId(){
		return $this->lista->usuario->id;
	}
}