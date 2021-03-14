<div class="panel panel-primary">
	<div class="panel-heading">Menu</div>
		<div class="panel-body">
			<ul class="nav nav-pills nav-stacked">
			@if(auth()->check())
			<!-- activando o menu base -->
			<li @if(request()->is('home')) class="active" @endif><a href="/home" >Dashboard</a>
			</li>
			<!-- validando o utilizador cliente -->
			@if (! auth()->user()->is_cliente)
			<li @if(request()->is('ver')) class="active" @endif><a href="/ver">Ver Ocorrências</a>
			</li>
			@endif

			<li @if(request()->is('reportar')) class="active" @endif><a href="/reportar">Adicionar Ocorrência</a>
			</li>
			<!-- opcoes do menu de administracao -->
			@if (auth()->user()->is_admin)
			<li role="presentation" class="dropdown">
				<a href="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Administração <span class="caret"></span>
				</a>
				<ul>
					<li><a href="/usuarios">Usuários</a></li>
					<li><a href="/projectos">Projectos</a></li>
					<li><a href="/config">Configurações</a></li>
				</ul>
			</li>
			@endif
			
			<!-- esta opcao aparece se o usuario nao logar -->
			@else
			<li><a href="/">Bem Vindo</a>
			</li>
			<li><a href="/instrucoes">Instruções</a>
			</li>
			<li><a href="/acerca-de">Sobre</a>
			</li>
			@endif
			 
			</ul>
		</div>
</div>