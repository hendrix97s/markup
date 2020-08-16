<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("produtos")->insert([
            'codigo' => "SD-5100",
            'descricao' => "SD-5100 - BOCA, NARIZ, FARINGE, LARINGE C/ VASOS E NERVOS",
            'valor_compra' => 638.39,
            'valor_venda' => 970.00,
            'comprimento' => 25,
            'largura' => 20,
            'altura' => 10,
            'peso' => 0.735,
        ]);

    }
}
