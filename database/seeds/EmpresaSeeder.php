<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("empresas")->insert([
            'nome_empresarial' => "LUIZ FELIPE LIMA PEREIRA 42520197889",
            'nome_fantasia' => "AXON SISTEMAS",
            'cnpj' => "36.642.493/0001-00",
            'ie' => "182.242.741.119",
            'cep' => "13604136",
            'endereco' => "RUA FAUSTO FRANCISCO",
            'numero' => "330",
            'bairro' => "JD. TARUMÃ",
            'municipio' => "ARARAS",
            'uf'=>"SP",
        ]);
    }
}
