@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">Registar Ocorrência</div>
        	<div class="panel-body">
        	@if (session('notification') )
        		<div class="alert alert-success">
        		 	{{ session('notification')}}
        		</div>
        	@endif
       
              
                 <!-- tabela de resmo de ocorrencias  -->
            <table class="table table-bordered">
            	<thead>
            		<tr>
            			<th>Código</th>
            			<th>Projecto</th>
            			<th>Categoria</th>
            			<th>Data de envio</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td id="ocorrencia_shave">{{ $ocorrencia->id }}</td>
            			<td id="ocorrencia_projecto">{{ $ocorrencia->project->nome }}</td>
            			<td id="ocorrencia_categoria">{{ $ocorrencia->category->nome}}</td>
            			<td id="ocorrencia_created_at">{{ $ocorrencia->created_at }}</td>
            		</tr>
            	</tbody>
            	<thead>
            		<tr>
            			<th>Registado para</th>
            			<th>Nivel</th>
            			<th>Estado</th>
            			<th>Prioridade</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td id="ocorrencia_responsavel">{{$ocorrencia->support_nome}}</td>
            			<td id="ocorrencia_publico">{{$ocorrencia->level->nome}}</td>
            			<td id="ocorrencia_estado">{{$ocorrencia->state}}</td>
            			<td id="ocorrencia_prioridade">{{$ocorrencia->prioridade_full}}</td>
            		</tr>
            	</tbody>
            </table>
            <!-- tabela para listar o resumo descricao e adjuntos -->
            <table class="table table-bordered">
            	<tbody>
            		<tr>
            			<th>Titulo</th>
            			<td id="ocorrencia_resumo">{{ $ocorrencia->title}}</td>
            		</tr>
            		<tr>
            			<th>Descrição</th>
            			<td id="ocorrencia_descricao">{{ $ocorrencia->descricao}}</td> 
            		</tr>
            		<tr>
            			<th>Anexos</th>
            			<td id="ocorrencia_anexo">Nao existe arquivos anexados</td>
            		</tr>
            	</tbody>
            </table>
            @if($ocorrencia->support_id == null && $ocorrencia->active && auth()->user()->canTake($ocorrencia))
            <a href="/ocorrencia/{{ $ocorrencia->id }}/atender" class="btn btn-primary btn-sm" id="incident_btn_apply">
            	Atender Ocorrencia
            </a>
            @endif
            <!-- opcoes do usuario que criou as ocorrencias-->
            @if( auth()->user()->id == $ocorrencia->client_id)
            	@if($ocorrencia->active)
            	<a href="/ocorrencia/{{ $ocorrencia->id }}/resolver" class="btn btn-info btn-sm" id="incident_btn_solve">
            	Marcar como resolvido
            	</a>
            	   <a href="/ocorrencia/{{ $ocorrencia->id }}/editar" class="btn btn-success btn-sm" id="incident_btn_edit">
            	Editar a ocorrencia
              	</a>
              	
            	@else
		            <a href="/ocorrencia/{{ $ocorrencia->id }}/abrir" class="btn btn-info btn-sm" id="incident_btn_open">
		            	Voltar a abrir a ocorrencia
		            </a>
                 @endif
              @endif

           
            <!-- mostra apenas se o usuario logado eh de suport -->
            @if( auth()->user()->id == $ocorrencia->support_id && $ocorrencia->active)
              <a href="/ocorrencia/{{ $ocorrencia->id }}/passar" class="btn btn-danger btn-sm" id="incident_btn_derive">
            	Passar ao nivel seguinte
            </a>
            @endif
                </div>
            </div>

<!-- incluindo layout do chat -->

@include('layouts.chat')
@endsection