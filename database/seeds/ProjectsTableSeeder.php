<?php

use Illuminate\Database\Seeder;
use App\Project;
class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
        		'nome' => 'Projecto A',
        		'descricao' =>'O projecto A consiste em desenvolver um projecto web moderno'

        	]); 

        	Project::create([
        		'nome' => 'Projecto B',
        		'descricao' =>'O projecto A consiste em desenvolver um projecto Android'

        	]);
    }
}
