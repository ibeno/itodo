@extends('template')

@section('conteudo')
	
		<div class="container">
			<div class="row">
				@if(count($errors) > 0)
					Erros encontrados: <br>
					<ul>
						@foreach($errors->all() as $e)
						<h5 class="alert alert-danger">{{ $e }}</h5>
						@endforeach
					</ul>
				@endif
			</div>
			<div class="col-md-12">
				
				{{ Form::open( array("action" => "liste/create", 'class'=>'form-horizontal')) }}
					
				<div class="form-group">
					{{ Form::label('titulo', 'Nova Lista:') }}
				</div>
				<div class="form-group">
					{{ Form::text('titulo', null, array('class'=>'form-control','placeholder' => 'Nova Tarefa')) }}
				</div>
				<div class="form-group">
					{{ Form::submit('Salvar', array('class' => 'btn btn-success')) }}			
				</div>
				{{ Form::close() }}				
			</div>
		</div>
	
		<div class="row">
			@if(isset($sucesso))
			<div class="container">
				<div class="alert alert-success">
					<h5>Nova Tarefa incluida!</h5>
				</div>
			</div>
			@endif
		</div>

@stop