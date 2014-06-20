<?php


class TaskController extends BaseController{

	public function getAdd($lista_id){

		if(List::findOrFail($lista_id)->usuario->id != Auth::user()->id)
			return Redirect::to('list');

			return View::make('add_task')->with('list_id', $lista_id);
	}

	public function postAdd(){

		if(List::findOrFail($lista_id)->usuario->id != Auth::user()->id)
			return Redirect::to('list');

		//regra de validação
		$regras = array('titulo' => 'required');

		//execução da validação
		$validacao = Validator::make(Input::all(), $regras);

		//se a validação der erro
		if ($validacao->fails()) {
			return Redirect::to('task/add' . $lista_id)->withErrors($validacao);
		}
		//se a validação deu certo
		else{
			$task = new Task;
			$task->titulo = Input::get('titulo');
			$task->list_id = $lista_id;
			$task->save();

			return View::make('add_task')->with('sucesso', TRUE)->with('list_id', $lista_id);
		}
	}

	public function getListar(){
		
		return View::make('list_tasks')->with('tasks', Task::all());
	}

	public function check(){

		//veeifica se é ajax
		if (Request::ajax()) {
			
			//criando regra de validação
			$regras = array('task_id' => 'required|integer');

			$validacao = Validador::make(Input::all(), $regras);

			if ($validacao->fails()) {
			
				return Response::json(array("status" => FALSE));
			
			}
			else{
				
				//tenta encontar e atualizar a task
				try{
					
					$task = Task::findOrFail(Input::get('task_id'));
					
					if ($task->getUsuarioId() != Auth::user()->id) {
						throw new Exception("Você não é dono desta Task");
					}
					$task->status = TRUE;
					$task->save();

					return Response::json(array("status" => TRUE, "titulo" => $task));
				}
				//caso não coniga encontrar a task				
				catch(Exception $e){
				
					return Response::json(array("status" => FALSE, "mensagem" => $e->getMessage()));
				}
			}
		}
	}
}