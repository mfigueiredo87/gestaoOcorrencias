@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">Registar Utilizador</div>
        	<div class="panel-body">
        	<!-- definindo a sessao -->
        		@if (session('notification') )
        		<div class="alert alert-success">
        		 	{{ session('notification')}}
        		</div>
        	@endif
        	<!-- definindo os erros -->
        	@if (count($errors) > 0)
        		<div class="alert alert-danger">
        			<ul>
        				@foreach ($errors->all() as $error)
        				<li>{{ $error}}</li>
        				@endforeach
        			</ul>
        		</div>
        	@endif
                 <!-- Definindo o formulario de relatorio -->
				<form action="" method="POST">

				{{ csrf_field() }}

				 
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" name="email" class="form-control" value="{{ old('email')}}">
					</div>	
					<div class="form-group">
						<label for="name">Nome</label>
						<input type="text" name="name" class="form-control" value="{{ old('name')}}">
					</div>	
					<div class="form-group">
						<label for="password">Senha</label>
						<input type="text" name="password" class="form-control" value="{{ old('password', str_random(8))}}">
					</div>

				 	<div class="form-group">
						<button class="btn btn-primary">Registar</button>
					</div>
				</form>

				<!-- formulario de listagem de utilizadores -->
				<p class="alert alert-info">Tabela de Utilizadores de Suporte</p>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>E-mail</th>
							<th>Nome</th>
							<th>Opções</th>
						</tr>
					</thead>
					
					<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{ $user->email}}</td>
							<td>{{ $user->name}}</td>
							<td>
								<a href="/usuario/{{ $user->id }}" class="btn btn-sm btn-primary" title="Editar">
								<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a href="/usuario/{{ $user->id }}/eliminar" class="btn btn-sm btn-danger" title="Apagar">
								<span class="glyphicon glyphicon-remove"></span>
								</a>
							</td>
						</tr>
					</tbody>
					@endforeach
				</table>

                </div>
            </div>


@endsection