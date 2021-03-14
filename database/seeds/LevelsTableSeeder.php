<?php

use Illuminate\Database\Seeder;
use App\level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
        	'nome' =>'Atendimento por telefone',
        	'project_id' => 1
        	]);
        Level::create([
        	'nome' =>'Atendimento Balcão',
        	'project_id' => 1
        	]);  
        Level::create([
        	'nome' =>'Envio do Técnico',
        	'project_id' => 2
        	]); 
        Level::create([
        	'nome' =>'Consulta especializada',
        	'project_id' => 2
        	]);
    }
}
