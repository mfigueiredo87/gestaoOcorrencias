<?php

use Illuminate\Database\Seeder;
use App\User;
class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          User::create([//3
        	'name'=>'Support S1',
        	'email'=>'support1@gmail.com',
        	'password'=>bcrypt('rosa'),
        	'role'=>'1'
        ]);
         User::create([//4
        	'name'=>'Support S2',
        	'email'=>'support2@gmail.com',
        	'password'=>bcrypt('rosa'),
        	'role'=>'1'
        ]);
    }
}
