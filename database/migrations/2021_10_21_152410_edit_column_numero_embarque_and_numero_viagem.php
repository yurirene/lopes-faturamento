<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnNumeroEmbarqueAndNumeroViagem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notas', function (Blueprint $table) {
            $table->string('numero_viagem')->nullable()->change();
            $table->string('numero_embarque')->nullable()->change();
            $table->string('nf_devolucao')->nullable()->change();
            $table->string('cte')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notas', function (Blueprint $table) {
            $table->integer('numero_viagem')->nullable()->change();
            $table->integer('numero_embarque')->nullable()->change();
            $table->integer('nf_devolucao')->nullable()->change();
            $table->integer('cte')->nullable()->change();
        });
    }
}
