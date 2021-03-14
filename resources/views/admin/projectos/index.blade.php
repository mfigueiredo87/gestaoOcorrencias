@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">Registar Projecto</div>
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
						<label for="nome">Nome</label>
						<input type="text" name="nome" class="form-control" value="{{ old('nome')}}">
					</div>	
					<div class="form-group">
						<label for="descricao">Descricao</label>
						<input type="text" name="descricao" class="form-control" value="{{ old('descricao')}}">
					</div>	
					<div class="form-group">
						<label for="start">Data de Registo</label>
						<input type="date" name="start" class="form-control" value="{{ old('start', date('Y-m-d'))}}">
					</div>

				 	<div class="form-group">
						<button class="btn btn-primary">Registar Projecto</button>
					</div>
				</form>

				<!-- formulario de listagem de utilizadores -->
				<p class="alert alert-info">Tabela de Projectos</p>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Descrição</th>
							<th>Data de Início</th>
							<th>Opções</th>
						</tr>
					</thead>
					
					<tbody>
				 		@foreach ($projects as $project)
						<tr>
							<td>{{ $project->nome}}</td>
							<td>{{ $project->descricao }}</td>
							<td>{{ $project->start ?: 'Nao registado'}}</td>
							<td>
							<!-- mostrar se o projecto foi eliminado ou nao -->
								@if ($project->trashed())
								<a href="/projecto/{{ $project->id}}/restaurar" class="btn btn-sm btn-success" title="Restaurar">
								<span class="glyphicon glyphicon-repeat"></span>
								</a>
								@else
								<a href="/projecto/{{ $project->id}}" class="btn btn-sm btn-primary" title="Editar">
								<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a href="/projecto/{{ $project->id}}/eliminar" class="btn btn-sm btn-danger" title="Apagar">
								<span class="glyphicon glyphicon-remove"></span>
								</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				 </table>
					</div>
				</div>

                </div>
            </div>


@endsection