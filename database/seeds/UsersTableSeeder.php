<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		//administrador
        User::create([//1
        	'name'=>'Manuel Figueiredo Armando',
        	'email'=>'mf-figueiredo@live.com.pt',
        	'password'=>bcrypt('figueiredo'),
        	'role'=>'0'
        ]);

        	//suporte
        // User::create([
        // 	'name'=>'Adameire Rosa',
        // 	'email'=>'adameire@gmail.com',
        // 	'password'=>bcrypt('rosa'),
        // 	'role'=>'1'
        // ]);

        	//cliente
        User::create([//2
        	'name'=>'Victorina Ricardo',
        	'email'=>'vicky@gmail.com',
        	'password'=>bcrypt('vivi'),
        	'role'=>'2'
        ]);
    }
}
