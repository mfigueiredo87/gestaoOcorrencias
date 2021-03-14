@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <!-- ocorrencias associadas a mim -->
          <!-- veificando o tipo de ususario logado -->

          @if( auth()->user()->is_support)
            <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Ocorrências associadas a mim</h3>
            </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               <th>Código</th> 
                               <th>Categoria</th>
                               <th>Prioridade</th> 
                               <th>Estado</th> 
                               <th>Data de Criação</th> 
                               <th>Resumo</th> 
                            </tr>
                        </thead>
                        <tbody id="dashboard_my_ocorrencies">
                          @foreach($my_ocorrencies as $ocorrencia)
                            <tr>
                              <td>
                                  <a href="/ver/{{ $ocorrencia->id}}">
                              {{ $ocorrencia->id}}
                              </a>
                             </td>
                               <td>{{ $ocorrencia->category->nome}}</td> 
                               <!-- mostra o texto em vez dos valores que existem no banco de dados, valores estes que vem do model -->
                               <td>{{ $ocorrencia->prioridade_full}}</td> 
                               <td>{{ $ocorrencia->state}}</td> 
                               <td>{{ $ocorrencia->created_at}}</td> 
                               <!-- restringindo o texto da descricao, trabalhado no model -->
                               <td>{{ $ocorrencia->descricao_curta}}</td>
                                
                              
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ocorrencias -->
                  <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Ocorrências não associadas ou pendentes</h3>
            </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               <th>Código</th> 
                               <th>Categoria</th>
                               <th>Prioridade</th> 
                               <th>Estado</th> 
                               <th>Data de Criação</th> 
                               <th>Resumo</th> 
                               <th>Opções</th> 
                            </tr>
                        </thead>
                        <tbody id="dashboard_pendentes">
                          @foreach($pendentes_ocorrencias as $pendentes)
                          <tr>
                             <td>
                                  <a href="/ver/{{ $pendentes->id}}">
                              {{ $pendentes->id}}
                              </a>
                             </td>
                               
                               <td>{{ $pendentes->category->nome}}</td> 
                               <td>{{ $pendentes->prioridade_full}}</td> 
                               <td>{{ $pendentes->state}}</td> 
                               <td>{{ $pendentes->created_at}}</td><td>{{ $pendentes->descricao_curta}}</td>                        
                               <td>
                                 <a href="" class="btn btn-primary btn-sm">Atender</a>
                               </td>
                          </tr>
                          @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            @endif
            <!-- ocorrencias -->
                  <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Ocorrências registadas por mim</h3>
            </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               <th>Código</th> 
                               <th>Categoria</th>
                               <th>Prioridade</th> 
                               <th>Estado</th> 
                               <th>Data de Criação</th> 
                               <th>Resumo</th> 
                               <th>Responsável</th> 
                            </tr>
                        </thead>
                        <tbody id="dashboard_to_me">
                        @foreach($minhas_ocorrencias as $minhas)
                          <tr>
                              <td>
                              <a href="/ver/{{ $minhas->id}}">
                              {{ $minhas->id}}
                              </a>
                              </td>
                               <td>{{ $minhas->category_nome}}</td> 
                               <td>{{ $minhas->prioridade_full}}</td> 
                               <td>{{ $minhas->state}}</td> 
                               <td>{{ $minhas->created_at}}</td><td>{{ $minhas->descricao_curta}}</td>                        
                               <td>
                                {{ $minhas->support_id ?: 'Nao indicado'}}
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
