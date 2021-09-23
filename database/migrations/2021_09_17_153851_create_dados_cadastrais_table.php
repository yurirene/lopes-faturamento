<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosCadastraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_cadastrais', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->nullable();
            $table->string('sigla', 20)->nullable();
            $table->string('descricao')->nullable();
            $table->decimal('peso_liquido')->nullable();
            $table->decimal('peso_bruto')->nullable();
            $table->integer('qtd_und_por_embalagem')->nullable();
            $table->decimal('peso_unidade')->nullable();
            $table->integer('validade')->nullable();
            $table->string('conservacao', 100)->nullable();
            $table->decimal('dim_emb_comprimento')->nullable();
            $table->decimal('dim_emb_largura')->nullable();
            $table->decimal('dim_emb_altura')->nullable();
            $table->string('ean')->nullable();
            $table->integer('qtd_und_caixa')->nullable();
            $table->decimal('peso_liquido_caixa')->nullable();
            $table->decimal('peso_bruto_caixa')->nullable();
            $table->string('dun')->nullable();
            $table->decimal('dim_cx_emb_comprimento')->nullable();
            $table->decimal('dim_cx_emb_largura')->nullable();
            $table->decimal('dim_cx_emb_altura')->nullable();
            $table->integer('lastro')->nullable();
            $table->integer('camada')->nullable();
            $table->integer('total')->nullable();
            $table->decimal('palet_altura')->nullable();
            $table->decimal('palet_peso_liquido')->nullable();
            $table->decimal('palet_peso_bruto')->nullable();
            $table->string('ncm')->nullable();
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
        Schema::dropIfExists('dados_cadastrais');
    }
}
