<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContaBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("contas_bancarias")->insert([
            'nome_favorecido' => "AXON SISTEMAS",
            'cnpj' => "36.642.493/0001-00",
            'banco' => "260 - Nu Pagamentos S.A.",
            'agencia' => "0001",
            'conta' => "73408351-8",
        ]);
    }
}
