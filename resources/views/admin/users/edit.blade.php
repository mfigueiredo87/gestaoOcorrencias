@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">Editar Utilizador</div>
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
						<input type="email" name="email" class="form-control" readonly="" value="{{ old('email', $user->email)}}">
					</div>	
					<div class="form-group">
						<label for="name">Nome</label>
						<input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
					</div>	
					<div class="form-group">
						<label for="password">Senha <em class="alert-danger">Inserir senha somente se desejar altera-la.</em></label>
						<input type="text" name="password" class="form-control" value="{{ old('password')}}">
					</div>

				 	<div class="form-group">
						<button class="btn btn-primary">Guardar</button>
					</div>
				</form>

				<!-- opcoes -->
				<form action="/projecto-usuario" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="user_id" value="{{ $user->id }}">
				<div class="row">
					<div class="col-md-4">
						<select class="form-control" name="project_id" id="select-project">
							<option value="">Seleccionar Projecto</option>
							@foreach($projects as $project)
							<option value="{{$project->id}}">{{ $project->nome }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
						<select class="form-control" name="level_id" id="select-level">
							<option value="">Seleccionar Nivel</option>
						</select>
					</div><div class="col-md-4">
						<button class="btn btn-primary btn-block">Associar Projecto</button>
					</div>
				</div>
				</form>
				<br>
				<!-- formulario de listagem de projectos -->
				<h5 class="alert-success sm">Projectos Marcados</h5>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Projectos</th>
							<th>Nivel</th>
							<th>Opções</th>
						</tr>
					</thead>
					
					<tbody>
					 @foreach($projects_user as $project_user)
						<tr>
							<td>{{ $project_user->project->nome }} </td>
							<td>{{ $project_user->level->nome }} </td>
							<td>
								<a href="" class="btn btn-sm btn-primary" title="Editar">
								<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a href="/projecto-usuario/{{$project_user->id}}/eliminar" class="btn btn-sm btn-danger" title="Apagar">
								<span class="glyphicon glyphicon-remove"></span>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>

				</table>

                </div>
            </div>

@endsection

@section('scripts')
	<script src="/js/admin/users/edit.js"></script>
@endsection