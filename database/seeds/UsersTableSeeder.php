<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ESHOPPER',
            'email' => 'shajib50cse@gmail.com',
            'password' => bcrypt('Shajib50'),
            'roles'	=> 1,
        ]);

        DB::table('users')->insert([
            'name' => 'ESHOPPER',
            'email' => 'nagetivenakib@gmail.com',
            'password' => bcrypt('Shajib50'),
            'roles' => 1,
        ]);
    }
}
