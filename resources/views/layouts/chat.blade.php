<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Fórum ou Discussão</h3>
	</div>
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

		<ul class="media-list">
			@foreach ($messages as $message)
			<li class="media">
				<div class="media-body">
					<div class="media">
						<a href="#" class="pull-left">
							<!-- a rota avatar_path vai ser util para alterar a imagem de acordo ao usuario que teclou e deve ser criada no modelo User -->
							<img class="media-object img-circle" src="{{$message->user->avatar_path}}"  width="48">
						</a>
						<div class="media-body">
							 {{ $message->message}}
							<br>
							<!-- Criar a relacao no model Message -->
							<small>{{$message->user->name}} | {{ $message->created_at}}</small>
							<hr>
						</div>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="panel-footer">
		<form action="/mensagens" method="POST">
				{{ csrf_field() }}
		<input type="hidden" name="ocorrencia_id" value="{{ $ocorrencia->id}}">
			<div class="input-group">
				<input type="text" class="form-control" name="message">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">Enviar</button>
				</span>
			</div>
		</form>
	
	</div>
	
</div>