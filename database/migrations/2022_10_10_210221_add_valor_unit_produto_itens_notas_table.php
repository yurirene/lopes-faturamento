<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorUnitProdutoItensNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens_notas', function (Blueprint $table) {
            $table->decimal('valor_unitario', 8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens_notas', function (Blueprint $table) {
            $table->dropColumn('valor_unitario');
        });
    }
}
