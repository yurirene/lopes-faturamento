<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unique();
            $table->string('pedido_cliente')->nullable();
            $table->date('emissao');
            $table->date('chegada')->nullable();
            $table->date('chegada_porto')->nullable();
            $table->decimal('valor_bruto');
            $table->decimal('valor_liquido');
            $table->decimal('peso_bruto')->nullable();
            $table->decimal('peso_liquido')->nullable();
            $table->string('cidade_entrega')->nullable();
            $table->integer('cte')->nullable();
            $table->string('placa')->nullable();
            $table->string('transportadora')->nullable();
            $table->date('data_entrega')->nullable();
            $table->date('data_reentrega')->nullable();
            $table->tinyInteger('canhoto')->default(0);
            $table->integer('nf_devolucao')->nullable();
            $table->decimal('valor_frete')->nullable();
            $table->string('observacao')->nullable();
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('industria_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('industria_id')->references('id')->on('industrias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
