<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('nome_favorecido');
            $table->string('cnpj');
            $table->string('banco');
            $table->string('agencia');
            $table->string('conta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_bancarias');
    }
}
