<?php

use Illuminate\Database\Seeder;
use App\Ocorrencia;

class OcorrenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ocorrencia::create([
        	'title'=>'Primeira Ocorrencia',
        	'descricao'=>'Testando a primeira Ocorrencia',
        	'prioridade' =>'N',
        	//chaves
        	'category_id'=>2,
        	'project_id'=>1,
        	'level_id'=>1,

        	'client_id'=> 2,
        	'support_id' => 3
        	]);
    }
}
