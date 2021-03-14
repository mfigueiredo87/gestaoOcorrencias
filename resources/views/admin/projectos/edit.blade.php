@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">Editar Projectos</div>
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
						<input type="text" name="nome" class="form-control" value="{{ old('nome', $project->nome)}}">
					</div>	
					<div class="form-group">
						<label for="name">Descricao</label>
						<input type="text" name="descricao" class="form-control" value="{{ old('name',$project->descricao) }}">
					</div>	
					<div class="form-group">
						<label for="password">Data de Inicio</label>
						<input type="date" name="start" class="form-control" value="{{ old('start', $project->start) }}">
					</div>

				 	<div class="form-group">
						<button class="btn btn-primary">Guardar Projecto</button>
					</div>
				</form>

				<div class="row">
					<div class="col-md-6">
					<p>Categorias</p>
						<form action="/categorias" method="POST" class="form-inline">
						{{ csrf_field()}}
						<!-- Passando o id do projecto -->
						<input type="hidden" name="project_id" value="{{ $project->id}}">
							<div class="form-group">
								<input type="text" name="nome" placeholder="Insira a categoria" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Adicionar</button>
							</div>
						</form>
<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Opções</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($categories as $category)
					 	<tr>
							<td>{{ $category->nome}}</td>
							 <td>
								<button type="button" class="btn btn-sm btn-primary" title="Editar" data-category="{{ $category->id}}">
								<span class="glyphicon glyphicon-pencil"></span>
								</button>
								<a href="/categoria/{{$category->id}}/eliminar" class="btn btn-sm btn-danger" title="Apagar">
								<span class="glyphicon glyphicon-remove"></span>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
					</div>
					<div class="col-md-6">
						<p>Níveis</p>
								<form action="/niveis" method="POST" class="form-inline">
							{{ csrf_field()}}
							<input type="hidden" name="project_id" value="{{ $project->id}}">
							<div class="form-group">
								<input type="text" name="nome" placeholder="Insira o nivel" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Adicionar</button>
							</div>
						</form>
						<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Nível</th>
							<th>Opções</th>
						</tr>
					</thead>
					<tbody>
					@foreach( $levels as $key=> $level)
					 	<tr>
					 	<!-- Para colocar os numeros automaticamente em vez do id e o key inicial fica na posicao 0, dai a necessidade de key+1 para o primeiro valor ser 1 e fazer o incremento -->
							<td>Nº {{ $key+1}} </td> 
							<td>{{ $level->nome }}</td>
							<td>
								<button class="btn btn-sm btn-primary" title="Editar" data-level="{{ $level->id}}">
								<span class="glyphicon glyphicon-pencil"></span>
								</button>
								<a href="/nivel/{{$level->id}}/eliminar" class="btn btn-sm btn-danger" title="Apagar">
								<span class="glyphicon glyphicon-remove"></span>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
					</div>
				</div>

                </div>
            </div>

<!-- modal para editar a Categoria -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditCategory">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
			<h4>Editar Categoria</h4>
			</div>
			<form action="/categoria/editar" method="POST">
			{{ csrf_field()}}
			<div class="modal-body">
				
				<input type="hidden" name="category_id" id="category_id" value="">
					<div class="form-group">
						<label for="nome">Nome da Categoria</label>
						<input type="text" name="nome" class="form-control" name="nome" id="category_nome" value="">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>		
	</div>
</div>

<!-- modal para editar o Nivel -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditLevel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
			<h4>Editar Nível</h4>
			</div>
			<form action="/nivel/editar" method="POST">
			{{ csrf_field()}}
			<div class="modal-body">
				
				<input type="hidden" name="level_id" id="level_id" value="">
					<div class="form-group">
						<label for="nome">Nome do Nivel</label>
						<input type="text" name="nome" class="form-control" name="nome" id="level_nome" value="" >
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>		
	</div>
</div>



@endsection
<!-- javascript para fazer funcionar o modal -->
@section('scripts')
<script src="/js/admin/projects/edit.js"></script>

@endsection

