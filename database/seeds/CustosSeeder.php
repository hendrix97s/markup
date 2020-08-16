<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("custos")->insert([
            [
                'plataforma' => "ML",
                'descricao' => "30 DIAS",
                'taxa' => 3.99
            ],
        ]);
        //
        DB::table("custos")->insert([
            [
                'plataforma' => "ML",
                'descricao' => "14 DIAS",
                'taxa' => 4.49
            ],
        ]);
        //
        DB::table("custos")->insert([
            [
                'plataforma' => "ML",
                'descricao' => "NA HORA",
                'taxa' => 4.99
            ],
        ]);
        //
        DB::table("custos")->insert([
            [
                'plataforma' => "PS",
                'descricao' => "30 DIAS",
                'taxa' => 3.99
            ],
        ]);
        //
        DB::table("custos")->insert([
            [
                'plataforma' => "PS",
                'descricao' => "14 DIAS",
                'taxa' => 4.99
            ],

        ]);
        DB::table("custos")->insert([
            [
                'plataforma' => "PS",
                'descricao' => "14 DIAS (ATUAL)",
                'taxa' => 2.99
            ],

        ]);
    }
}
