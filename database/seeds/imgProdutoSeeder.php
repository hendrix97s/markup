<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class imgProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("img_produtos")->insert(
            [
                'codigo' => "SD-5100",
                'img_url' => "https://i.postimg.cc/h4kxDpW2/e-SD-5100-1.jpg",
            ],
        ); //
        DB::table("img_produtos")->insert(
            [
                'codigo' => "SD-5100",
                'img_url' => "https://i.postimg.cc/pLxF8rd8/e-SD-5100-2.jpg",
            ],
        );
        DB::table("img_produtos")->insert(
            [
                'codigo' => "SD-5100",
                'img_url' => "https://i.postimg.cc/rF54KxqM/e-SD-5100-3.jpg",
            ],
        );
        DB::table("img_produtos")->insert(
            [
                'codigo' => "SD-5100",
                'img_url' => "https://i.postimg.cc/yWC7MDGT/e-SD-5100-4.jpg",
            ],
        );
        DB::table("img_produtos")->insert(
            [
                'codigo' => "SD-5100",
                'img_url' => "https://i.postimg.cc/c1gwGPjK/e-SD-5100-5.jpg",
            ],
        );
    }
}
