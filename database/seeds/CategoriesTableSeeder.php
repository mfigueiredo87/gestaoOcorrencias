<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Category::create([
        	'nome'=>'Categoria A1',
        	// 'descricao' =>'',
        	'project_id' =>1
        	]);

        Category::create([
        	'nome'=>'Categoria A2',
        	// 'descricao' =>'',
        	'project_id' =>1
        	]);

        Category::create([
        	'nome'=>'Categoria B1',
        	// 'descricao' =>'',
        	'project_id' =>2
        	]);

        Category::create([
        	'nome'=>'Categoria B2',
        	// 'descricao' =>'',
        	'project_id' =>2
        	]);
    }
}
