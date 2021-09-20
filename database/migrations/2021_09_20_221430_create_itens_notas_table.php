<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_notas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo_produto');
            $table->integer('caixa_fardo');
            $table->decimal('peso_liquido');
            $table->bigInteger('nota_id')->unsigned();
            $table->timestamps();

            $table->foreign('nota_id')->references('id')->on('notas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_notas');
    }
}
