@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">Registar Ocorrência</div>
        	<div class="panel-body">

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
						<label for="category_id">Categoria</label>
						<select name="category_id" class="form-control">
						<option value="">Geral</option>
							@foreach($categories as $category)
								<option value="{{ $category->id}}">{{ $category->nome}} </option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="prioridade">Prioridade</label>
						<select name="prioridade" class="form-control">
						<option value="B">Baixa</option>
						<option value="N">Normal</option>
						<option value="A">Alta</option>
						</select>
					</div>
					<div class="form-group">
						<label for="title">Título</label>
						<input type="text" name="title" class="form-control" value="{{ old('title')}}">
					</div>
					<div class="form-group">
						<label for="descricao">Descrição</label>
						<textarea name="descricao" class="form-control">{{ old('descricao')}}</textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Registar Ocorrência</button>
					</div>
				</form>

                </div>
            </div>


@endsection