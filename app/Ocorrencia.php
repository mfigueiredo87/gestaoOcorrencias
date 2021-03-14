<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;


class Ocorrencia extends Model
{
          //validando
      public static  $rules =[
            'category_id' => 'sometimes|exists:categories,id',//indica que o valor da categoria no caso id ja existe na tabela categories
            'prioridade' => 'required|in:B,N,A',
            'title' => 'required|min:10',
            'descricao' => 'required|min:20'
        ];
        //regra de mensagens de erros
       public static $messages = [
            'category_id.exists' =>'Não foi encontrada a categoria selecionada na Base de Dados.',
            'title.required' =>'É necessário inserir um título para a ocorrência',
            'title.min' =>'É necessário inserir um título de pelo menos 5 caracteres.',
            'descricao.required' => 'É necessário inserir uma descrição da ocorrencia.',
             'descricao.min' => 'É necessário inserir uma descrição da ocorrencia de no mínimo 15 caracteres.'
        ];

    //criando as relacoes 1 para muitos


    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    } 
    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function support(){
        return $this->belongsTo('App\User','support_id');//chamando o nome do usuario de suporte
    }

    public function client(){
        return $this->belongsTo('App\User','client_id');
    }
    //uma mensagem pertence a uma ocorrencia, usamos o hasMany
    public function messages(){
        return $this->hasMany('App\Message');
    }

    //convertendo os dados que existem no banco de dados para o nome completo
    public function getPrioridadeFullAttribute(){
    	//criar um switch para alterar

    	switch ($this->prioridade) {
    		case 'B':
    			return 'Baixa';
    			 
    		case 'N':
    			return 'Normal';
    			     		
    		default:
    			return 'Alta';
    			break;
    	}
    }

    public function getDescricaoCurtaAttribute(){
    	return mb_strimwidth($this->descricao, 0, 35, '...'); //este metodo reduz o tamanho do dexto e no caso comecando em 0 e vai mostrar 30 letras e terminar com ...
    }

    public function getCategoryNomeAttribute(){
        if($this->category)
            return $this->category->nome;

        //else
        return 'Geral';
    }

    //passando o acessor para o nome do usuario, cliente, support ou admin da qual foi registada a incidencia
    public function getSupportNomeAttribute(){

        if($this->support)
            return $this->support->name;
            //se nao
        return 'Nao registado';
    }
    //listar o estado da ocorrencia
    public function getStateAttribute(){

        if($this->active == 0)
            return 'Resolvido';
        //se o superid for de suport o estado passa para resolvido
        if($this->support_id)
            return 'Registado';
        //em ultimos casos pendentes
        return 'Pendente';
    }
}
