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
        //
        DB::table('users')->insert(
            [
                'name' => 'Luiz Felipe Lima Pereira',
                'email' => 'luiz.lima@axonsistemas.com.br',
                'password' => Hash::make('Felipe@11041993'),
            ],
        );

        //
        DB::table('users')->insert(
            [
                'name' => 'João Victor Lima Pereira',
                'email' => 'vendas@axonsistemas.com.br',
                'password' => Hash::make('Felipe@11041993'),
            ],
        );
    }
}
