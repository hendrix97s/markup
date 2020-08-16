<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
                ContaBancariaSeeder::class,
                CustosSeeder::class,
                EmpresaSeeder::class,
                ProdutosSeeder::class,
                imgProdutoSeeder::class,
                TokenSeeder::class,
            ]
        );
    }
}
