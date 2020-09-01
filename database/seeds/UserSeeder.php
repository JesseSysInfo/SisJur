<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Jesse de Oliveira Abreu',
            'email' => 'jesse.ti.305@gmail.com',
            'password' => Hash::make('teste123'), 
            'ativo' => 1
        ]);
    }
}
