<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Model\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    //


    protected $request;
    protected $produto;

    public function __index(Request $request, Produtos $produto){
        $this->request = $request;
        $this->produto = $produto;
    }   

    public function getProduto($codigo){
        // $produto = $this->produto->where('codigo','=', $codigo)->get();
        $produto = DB::table('produtos')->where('codigo','=',$codigo)->get();
        $img_produto = DB::table('img_produtos')->where('codigo','=',$codigo)->get();
        // return response()->json($produto,200);
        return response()->json( ['item'=>$produto[0],'img'=>$img_produto[0]],200);
    }
}
