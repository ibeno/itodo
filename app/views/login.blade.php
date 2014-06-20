@extends('template')

@section('conteudo')

  
 
      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Efetue Login</h2>
        <input type="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

@stop