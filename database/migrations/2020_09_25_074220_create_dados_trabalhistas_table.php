<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosTrabalhistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_trabalhistas', function (Blueprint $table) {
            $table->id();
            $table->string('ctps')->nullable();
            $table->string('serie')->nullable();
            $table->string('pis_pasep')->nullable();
            $table->timestamps();

            $table->biginteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_trabalhistas');
    }
}
